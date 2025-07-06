<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-image: url("{{ public_path('front/assets/img/certificate-bg.jpg') }}");
            background-size: cover;
            background-position: center;
            text-align: center;
            padding: 60px 100px;
            color: #1e2a38; /* Dark blue text */
        }

        .certificate-title {
            font-size: 48px;
            font-weight: bold;
            margin-top: 30px;
            color: #b58b00; /* Gold-like color */
        }

        .subtitle {
            font-size: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .student-name {
            font-size: 32px;
            font-weight: bold;
            margin: 10px 0;
            color: #0d1c33;
        }

        .event-name {
            font-size: 24px;
            margin-top: 10px;
            font-style: italic;
            color: #333;
        }

        .footer {
            margin-top: 60px;
            font-size: 16px;
            color: #000;
        }

        .signature {
            display: flex;
            justify-content: space-around;
            margin-top: 80px;
            font-size: 16px;
        }

        .signature div {
            text-align: center;
        }

        .signature-line {
            margin-top: 50px;
            border-top: 1px solid #000;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>

    <div class="certificate-title">SERTIFIKAT KELULUSAN</div>

    <div class="subtitle">Diberikan kepada:</div>

    <div class="student-name">{{ $student->name }}</div>

    <div class="subtitle">Atas partisipasi dan kelulusan dalam:</div>

    <div class="event-name">"{{ $eventCourse->title }}"</div>

    <div class="subtitle">
        Telah menyelesaikan seluruh tugas dengan nilai minimal 80.
    </div>

    <div class="footer">
        Diterbitkan oleh: <strong>{{ $companyName ?? 'PT. Pembelajaran Indonesia' }}</strong><br>
        Pada tanggal: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>

    <div class="signature">
        <div>
            <div class="signature-line"></div>
            Ketua Panitia
        </div>
        <div>
            <div class="signature-line"></div>
            Direktur Program
        </div>
    </div>

</body>
</html>
