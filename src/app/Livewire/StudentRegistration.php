<?php

namespace App\Livewire;

use App\Models\EventCourse;
use App\Models\PendingTransaction;
use Livewire\Component;

class StudentRegistration extends Component
{
    public $eventCourse;
    public $name, $email, $phone;

    public function mount(EventCourse $eventCourse)
    {
        $this->eventCourse = $eventCourse;
    }

    public function register()
    {
        $this->validate([
            'name'  => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
        ]);

        $orderId = 'BOOT-' . time();

        // Simpan ke pending_transactions
        PendingTransaction::create([
            'order_id'        => $orderId,
            'name'            => $this->name,
            'email'           => $this->email,
            'phone'           => $this->phone,
            'event_course_id' => $this->eventCourse->id,
        ]);

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Buat payload Snap
        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $this->eventCourse->price,
            ],
            'customer_details' => [
                'first_name' => $this->name,
                'email'      => $this->email,
                'phone'      => $this->phone,
            ],
            'item_details' => [
                [
                    'id'       => $this->eventCourse->id,
                    'price'    => $this->eventCourse->price,
                    'quantity' => 1,
                    'name'     => $this->eventCourse->title,
                ],
            ],
            'callbacks' => [
                'finish' => url("/payment/finish?order_id={$orderId}"),
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return redirect()->to("https://app.sandbox.midtrans.com/snap/v2/vtweb/{$snapToken}");
    }

    public function render()
    {
        return view('livewire.student-registration');
    }
}
