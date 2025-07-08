<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Berhasil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="font-family: sans-serif; padding: 2rem; background-color: #f4f4f4;">

    <div style="max-width: 600px; margin: auto; background: white; padding: 2rem; border-radius: 8px;">
        <h1 style="color: green;">Pembayaran Berhasil 🎉</h1>
        <p>Cek WA Notification untuk melihat ID dan Password Untuk login</p>
        <p>Klik tombol di bawah untuk Memasuki E-learning Management System</p>

        <form action="{{ url('/midtrans/manual-callback') }}" method="POST">
            @csrf
            <input type="hidden" name="transaction_status" value="settlement">
            <input type="hidden" name="order_id" value="{{ request('order_id') }}">
            <input type="hidden" name="custom_field1" value="{{ session('name') }}">
            <input type="hidden" name="custom_field2" value="{{ session('email') }}">
            <input type="hidden" name="custom_field3" value="{{ session('phone') }}">

            <button type="submit" style="background: green; color: white; padding: 0.5rem 1rem; border: none; border-radius: 4px;">
                LMS Platform
            </button>
        </form>
    </div>

</body>
</html>
