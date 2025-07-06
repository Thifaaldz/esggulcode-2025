<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\MidtransCallbackController;
use App\Livewire\About;
use App\Livewire\Course;
use App\Livewire\HomePage;
use App\Livewire\Pengajar;
use App\Livewire\StudentRegistration;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', HomePage::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/course', Course::class)->name('course');
Route::get('/pengajar', Pengajar::class)->name('pengajar');
Route::get('/courses', [CourseController::class, 'index']);

Route::get('/register/{eventCourse}', StudentRegistration::class)->name('register.bootcamp');

Route::get('/payment/finish', function (\Illuminate\Http\Request $request) {
    return view('payment.success', [
        'order_id' => $request->order_id
    ]);
});

Route::post('/midtrans/manual-callback', [MidtransCallbackController::class, 'handle']);

Route::get('/test-wa', function () {
    $sid = config('services.twilio.sid');
    $token = config('services.twilio.token');
    $client = new \Twilio\Rest\Client($sid, $token);

    try {
        $client->messages->create(
            'whatsapp:+62895330347429', // PASTIKAN nomor ini benar
            [
                'from' => 'whatsapp:+14155238886',
                'body' => 'Tes berhasil dari Laravel!'
            ]
        );

        return 'Berhasil kirim WA';
    } catch (\Exception $e) {
        return 'Gagal kirim: ' . $e->getMessage();
    }
});

