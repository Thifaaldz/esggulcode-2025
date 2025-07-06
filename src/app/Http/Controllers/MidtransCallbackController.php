<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\PendingTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client as TwilioClient;
use Midtrans\Config;
use Midtrans\Transaction;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        $status  = $request->input('transaction_status');
        $orderId = $request->input('order_id');

        if ($status === 'settlement') {
            try {
                // Ambil detail transaksi
                $transaction = Transaction::status($orderId);
                Log::info('Midtrans transaction:', (array) $transaction);

                // Ambil data pending
                $pending = PendingTransaction::where('order_id', $orderId)->first();
                if (!$pending) {
                    Log::warning("PendingTransaction not found for order_id: {$orderId}");
                    return response()->json(['message' => 'Pending transaction not found'], 404);
                }

                $name  = $pending->name;
                $email = $pending->email;
                $phone = $pending->phone;
                $eventCourseId = $pending->event_course_id;

                $loginUrl = "https://esggulcode.test/student";
                $defaultPassword = 'password';

                // Buat akun user
                $user = User::firstOrCreate(
                    ['email' => $email],
                    ['name' => $name, 'password' => Hash::make($defaultPassword)]
                );

                // Buat/Update student
                Student::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'event_course_id' => $eventCourseId,
                        'phone' => $phone,
                    ]
                );

                // === 📲 Kirim WA via Twilio ===
                $normalizedPhone = preg_replace('/[^0-9]/', '', $phone);
                $normalizedPhone = preg_replace('/^0/', '62', $normalizedPhone);
                $whatsappTo = "whatsapp:+{$normalizedPhone}";

                $sid   = config('services.twilio.sid');
                $token = config('services.twilio.token');
                $from  = config('services.twilio.whatsapp_from');

                $twilio = new TwilioClient($sid, $token);
                $twilio->messages->create($whatsappTo, [
                    'from' => $from,
                    'body' => "Halo {$name}, pembayaran dengan ID {$orderId} telah *BERHASIL* ✅ pada " . now()->format('d M Y H:i') . " WIB.

Berikut akun kamu:
📧 Email: {$email}
🔑 Password: {$defaultPassword}

Login di:
🔗 {$loginUrl}

Terima kasih 🙏",
                ]);



                // Hapus data pending
                $pending->delete();
                
                return redirect('https://esggulcode.test/student');

                return response()->json(['message' => 'Callback processed and email/WA sent'], 200);

            } catch (\Exception $e) {
                Log::error('Midtrans callback error: ' . $e->getMessage());
                return response()->json(['message' => 'Internal server error'], 500);
            }
        }

        return response()->json(['message' => 'Transaction status not settlement'], 200);
    }
}
