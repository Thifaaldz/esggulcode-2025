<!DOCTYPE html>
<html>
<head>
    <style>
        body { text-align: center; font-family: sans-serif; }
        h1 { font-size: 36px; margin-top: 50px; }
        p { font-size: 18px; }
    </style>
</head>
<body>
    <h1>SERTIFIKAT KELULUSAN</h1>
    <p>Dengan ini menyatakan bahwa</p>
    <h2>{{ $student->name }}</h2>
    <p>telah menyelesaikan seluruh tugas dengan nilai minimal 80.</p>
    <br><br>
    <p>Diberikan pada tanggal {{ $date }}</p>
</body>
</html>
