<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Panen KUPS Harapan Asri</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12px;
            color: #000;
            background: #fff;
            padding: 30px 40px; /* Margins for A4 paper */
        }
        
        /* KOP SURAT (LETTERHEAD) */
        .kop-surat {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .kop-surat h1 {
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }
        .kop-surat p {
            font-size: 12px;
            line-height: 1.5;
        }

        /* TITLE */
        .report-title {
            text-align: center;
            margin-bottom: 25px;
        }
        .report-title h2 {
            font-size: 14px;
            text-decoration: underline;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .report-title p {
            font-size: 11px;
        }

        /* STAT INFO (OPTIONAL BUT GOOD) */
        .info-p {
            margin-bottom: 15px;
            font-size: 12px;
            text-align: justify;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 11px;
        }
        th {
            font-weight: bold;
            text-align: center;
            background-color: #f5f5f5;
        }
        .center { text-align: center; }
        .right { text-align: right; }
        .bold { font-weight: bold; }

        /* FOOTER SIGNATURE */
        .signature-area {
            width: 100%;
            margin-top: 40px;
        }
        .signature-box {
            float: right;
            text-align: center;
            width: 250px;
        }
        .signature-box .date {
            margin-bottom: 80px; /* Space for signature */
        }
        .signature-box .name {
            font-weight: bold;
            text-decoration: underline;
        }
        
        /* Clearfix */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        <h1>KUPS HARAPAN ASRI</h1>
        <p>
            Kelompok Usaha Perhutanan Sosial (KUPS) Budidaya Jamur Tiram<br>
            Jorong Tanah Bato Sijunjung, Kabupaten Sijunjung, Sumatera Barat
        </p>
    </div>

    <div class="report-title">
        <h2>Laporan Rekapitulasi Panen Harian</h2>
        <p>Data Per Tanggal Cetak: {{ $tanggalCetak }}</p>
    </div>

    <p class="info-p">
        Berikut ini adalah rekapitulasi data laporan panen harian yang telah melalui proses verifikasi dan validasi oleh Ketua KUPS:
    </p>

    <table>
        <thead>
            <tr>
                <th style="width:5%">No</th>
                <th style="width:20%">Tanggal Panen</th>
                <th style="width:25%">Nama Petugas</th>
                <th style="width:15%">Grade A (Kg)</th>
                <th style="width:15%">Grade B (Kg)</th>
                <th style="width:20%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $i => $r)
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td class="center">{{ optional($r->tanggal)->isoFormat('D MMMM Y') ?: $r->tanggal }}</td>
                <td>{{ optional($r->user)->name ?: '-' }}</td>
                <td class="center">{{ number_format($r->berat_grade_a, 1) }}</td>
                <td class="center">{{ number_format($r->berat_grade_b, 1) }}</td>
                <td class="center">Tervalidasi</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="center" style="padding: 20px;">
                    Tidak ada data laporan panen yang tervalidasi.
                </td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="right bold" style="padding-right: 15px;">TOTAL KESELURUHAN</td>
                <td class="center bold">{{ number_format($reports->sum('berat_grade_a'), 1) }} Kg</td>
                <td class="center bold">{{ number_format($reports->sum('berat_grade_b'), 1) }} Kg</td>
                <td class="center bold">{{ $jumlahLaporan }} Laporan</td>
            </tr>
        </tfoot>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Panen KUPS Harapan Asri</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12px;
            color: #000;
            background: #fff;
            padding: 30px 40px; /* Margins for A4 paper */
        }
        
        /* KOP SURAT (LETTERHEAD) */
        .kop-surat {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .kop-surat h1 {
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }
        .kop-surat p {
            font-size: 12px;
            line-height: 1.5;
        }

        /* TITLE */
        .report-title {
            text-align: center;
            margin-bottom: 25px;
        }
        .report-title h2 {
            font-size: 14px;
            text-decoration: underline;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .report-title p {
            font-size: 11px;
        }

        /* STAT INFO (OPTIONAL BUT GOOD) */
        .info-p {
            margin-bottom: 15px;
            font-size: 12px;
            text-align: justify;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 11px;
        }
        th {
            font-weight: bold;
            text-align: center;
            background-color: #f5f5f5;
        }
        .center { text-align: center; }
        .right { text-align: right; }
        .bold { font-weight: bold; }

        /* FOOTER SIGNATURE */
        .signature-area {
            width: 100%;
            margin-top: 40px;
        }
        .signature-box {
            float: right;
            text-align: center;
            width: 250px;
        }
        .signature-box .date {
            margin-bottom: 80px; /* Space for signature */
        }
        .signature-box .name {
            font-weight: bold;
            text-decoration: underline;
        }
        
        /* Clearfix */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        <h1>KUPS HARAPAN ASRI</h1>
        <p>
            Kelompok Usaha Perhutanan Sosial (KUPS) Budidaya Jamur Tiram<br>
            Jorong Tanah Bato Sijunjung, Kabupaten Sijunjung, Sumatera Barat
        </p>
    </div>

    <div class="report-title">
        <h2>Laporan Rekapitulasi Panen Harian</h2>
        <p>Data Per Tanggal Cetak: {{ $tanggalCetak }}</p>
    </div>

    <p class="info-p">
        Berikut ini adalah rekapitulasi data laporan panen harian yang telah melalui proses verifikasi dan validasi oleh Ketua KUPS:
    </p>

    <table>
        <thead>
            <tr>
                <th style="width:5%">No</th>
                <th style="width:20%">Tanggal Panen</th>
                <th style="width:25%">Nama Petugas</th>
                <th style="width:15%">Grade A (Kg)</th>
                <th style="width:15%">Grade B (Kg)</th>
                <th style="width:20%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $i => $r)
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td class="center">{{ optional($r->tanggal)->isoFormat('D MMMM Y') ?: $r->tanggal }}</td>
                <td>{{ optional($r->user)->name ?: '-' }}</td>
                <td class="center">{{ number_format($r->berat_grade_a, 1) }}</td>
                <td class="center">{{ number_format($r->berat_grade_b, 1) }}</td>
                <td class="center">Tervalidasi</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="center" style="padding: 20px;">
                    Tidak ada data laporan panen yang tervalidasi.
                </td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="right bold" style="padding-right: 15px;">TOTAL KESELURUHAN</td>
                <td class="center bold">{{ number_format($reports->sum('berat_grade_a'), 1) }} Kg</td>
                <td class="center bold">{{ number_format($reports->sum('berat_grade_b'), 1) }} Kg</td>
                <td class="center bold">{{ $jumlahLaporan }} Laporan</td>
            </tr>
        </tfoot>
    </table>

    <div class="signature-area clearfix">
        <div class="signature-box">
            <div class="date">Sijunjung, {{ now()->isoFormat('D MMMM Y') }}</div>
            <div class="name">Ketua KUPS Harapan Asri</div>
        </div>
    </div>

</body>
</html>
