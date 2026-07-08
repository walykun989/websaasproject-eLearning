<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat - {{ $certificate->certificate_number }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            width: 297mm;
            height: 210mm;
            margin: 0;
            padding: 0;
            font-family: 'Georgia', 'Times New Roman', serif;
            background: #ffffff;
            position: relative;
            overflow: hidden;
            page-break-after: avoid;
            page-break-before: avoid;
            page-break-inside: avoid;
        }
        .container {
            width: 100%;
            height: 100%;
            position: relative;
            page-break-inside: avoid;
        }
        .border-frame {
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border: 3px solid #1a1a1a;
            pointer-events: none;
        }
        .border-frame-inner {
            position: absolute;
            top: 22px;
            left: 22px;
            right: 22px;
            bottom: 22px;
            border: 1px solid #1a1a1a;
            pointer-events: none;
        }
        .header {
            text-align: center;
            padding-top: 35px;
        }
        .header .title {
            font-size: 13px;
            letter-spacing: 5px;
            text-transform: uppercase;
            color: #555;
            margin-bottom: 8px;
        }
        .header .institution {
            font-size: 28px;
            font-weight: bold;
            color: #1a1a1a;
            letter-spacing: 2px;
            margin-bottom: 4px;
        }
        .header .subtitle {
            font-size: 12px;
            color: #777;
            letter-spacing: 2px;
        }
        .divider {
            width: 100px;
            height: 2px;
            background: #1a1a1a;
            margin: 18px auto;
        }
        .cert-title {
            text-align: center;
            font-size: 20px;
            letter-spacing: 7px;
            text-transform: uppercase;
            color: #1a1a1a;
            margin-top: 15px;
        }
        .content {
            text-align: center;
            padding: 0 70px;
            margin-top: 15px;
        }
        .content p {
            font-size: 15px;
            color: #444;
            line-height: 1.6;
            margin: 8px 0;
        }
        .content .name {
            font-size: 36px;
            font-weight: bold;
            color: #1a1a1a;
            margin: 15px 0;
            letter-spacing: 1px;
        }
        .content .course-name {
            font-size: 18px;
            color: #1a1a1a;
            font-weight: bold;
            margin: 10px 0;
        }
        .footer {
            position: absolute;
            bottom: 40px;
            left: 50px;
            right: 50px;
            display: flex;
            justify-content: space-between;
        }
        .footer .left, .footer .right {
            text-align: center;
        }
        .footer .label {
            font-size: 10px;
            color: #888;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .footer .value {
            font-size: 13px;
            color: #1a1a1a;
        }
        .cert-number {
            position: absolute;
            bottom: 18px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 9px;
            color: #aaa;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="border-frame"></div>
        <div class="border-frame-inner"></div>

        <div class="header">
            <div class="title">Sertifikat Penyelesaian</div>
            <div class="institution">Waktu Informatika Belajar</div>
            <div class="subtitle">Platform E-Learning Informatika</div>
        </div>

        <div class="divider"></div>

        <div class="cert-title">Sertifikat Keberhasilan</div>

        <div class="content">
            <p>Dengan ini menyatakan bahwa</p>
            <div class="name">{{ $certificate->user->name }}</div>
            <p>telah berhasil menyelesaikan program pembelajaran</p>
            <div class="course-name">{{ $certificate->course->title }}</div>
            <p>pada <strong>{{ \Carbon\Carbon::parse($certificate->issued_at)->isoFormat('D MMMM YYYY') }}</strong></p>
            <p style="margin-top: 12px;">Dengan penuh dedikasi dan ketekunan, peserta telah menunjukkan kemampuan<br>yang luar biasa dalam menguasai materi pada program ini.</p>
        </div>

        <div class="footer">
            <div class="left">
                <div class="label">Nomor Sertifikat</div>
                <div class="value" style="font-size: 11px;">{{ $certificate->certificate_number }}</div>
            </div>
            <div class="right">
                <div class="label">Tanggal Terbit</div>
                <div class="value">{{ \Carbon\Carbon::parse($certificate->issued_at)->isoFormat('D MMMM YYYY') }}</div>
            </div>
        </div>

        <div class="cert-number">{{ $certificate->certificate_number }} &bull; Waktu Informatika Belajar</div>
    </div>
</body>
</html>
