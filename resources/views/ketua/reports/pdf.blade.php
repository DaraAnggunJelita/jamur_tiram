<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Panen KUPS Harapan Asri</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #1e293b;
            background: #fff;
        }

        /* HEADER */
        .header {
            background: linear-gradient(135deg, #0d7844 0%, #0a5e35 100%);
            color: white;
            padding: 18px 24px;
            margin-bottom: 0;
        }
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .org-name {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        .org-sub {
            font-size: 10px;
            opacity: 0.8;
            margin-top: 3px;
        }
        .report-title {
            text-align: right;
        }
        .report-title h1 {
            font-size: 14px;
            font-weight: bold;
        }
        .report-title p {
            font-size: 9px;
            opacity: 0.75;
            margin-top: 3px;
        }

        /* META INFO STRIP */
        .meta-strip {
            background: #e6f4ee;
            border-bottom: 2px solid #0d7844;
            padding: 8px 24px;
            display: flex;
            justify-content: space-between;
            font-size: 9px;
            color: #0a5e35;
        }
        .meta-strip span { font-weight: bold; }

        /* STATS ROW */
        .stats-row {
            display: flex;
            gap: 0;
            margin: 16px 24px;
            border: 1px solid #d1fae5;
            border-radius: 8px;
            overflow: hidden;
        }
        .stat-box {
            flex: 1;
            text-align: center;
            padding: 10px 8px;
            border-right: 1px solid #d1fae5;
            background: #f0faf5;
        }
        .stat-box:last-child { border-right: none; }
        .stat-label {
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0a5e35;
            font-weight: bold;
        }
        .stat-value {
            font-size: 16px;
            font-weight: bold;
            color: #0d7844;
            margin-top: 3px;
        }
        .stat-unit {
            font-size: 9px;
            color: #555;
        }

        /* TABLE */
        .table-wrap { padding: 0 24px 20px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0;
        }
        thead tr {
            background: #0a5e35;
            color: white;
        }
        thead th {
            padding: 8px 10px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            text-align: left;
        }
        thead th.center { text-align: center; }

        tbody tr:nth-child(even) { background: #f0faf5; }
        tbody tr:nth-child(odd)  { background: #ffffff; }
        tbody td {
            padding: 7px 10px;
            font-size: 10px;
            border-bottom: 1px solid #d1fae5;
            color: #1e293b;
        }
        tbody td.center { text-align: center; }
        tbody td.bold { font-weight: bold; }
        tbody td.num { text-align: center; font-weight: bold; color: #0d7844; }

        .badge-valid {
            display: inline-block;
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
            border-radius: 4px;
            padding: 2px 7px;
            font-size: 9px;
            font-weight: bold;
        }
        .badge-kondisi {
            display: inline-block;
            background: #e0f2fe;
            color: #075985;
            border-radius: 4px;
            padding: 2px 7px;
            font-size: 9px;
        }

        /* TOTAL ROW */
        tfoot tr {
            background: #0d7844;
            color: white;
        }
        tfoot td {
            padding: 9px 10px;
            font-size: 10px;
            font-weight: bold;
        }

        /* FOOTER */
        .footer {
            margin: 10px 24px 0;
            padding-top: 10px;
            border-top: 1px solid #d1fae5;
            display: flex;
            justify-content: space-between;
            font-size: 8.5px;
            color: #64748b;
        }
        .footer .signature {
            text-align: center;
        }
        .footer .signature .line {
            width: 140px;
            border-bottom: 1px solid #94a3b8;
            margin: 30px auto 4px;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="header-top">
            <div>
                <div class="org-name">KUPS Harapan Asri</div>
                <div class="org-sub">Kelompok Usaha Bersama Budidaya Jamur Tiram<br>Jorong Tanah Bato Sijunjung, Kabupaten Sijunjung</div>
            </div>
            <div class="report-title">
                <h1>LAPORAN REKAPITULASI PANEN</h1>
                <p>Dicetak: {{ $tanggalCetak }}</p>
                <p>Hanya memuat laporan berstatus: Tervalidasi</p>
            </div>
        </div>
    </div>

    <div class="meta-strip">
        <div>Periode: Seluruh Data Tervalidasi</div>
        <div>Total Laporan: <span>{{ $jumlahLaporan }}</span> &nbsp;|&nbsp; Total Panen: <span>{{ number_format($totalPanen, 1) }} Kg</span></div>
    </div>

    <div class="stats-row">
        <div class="stat-box">
            <div class="stat-label">Total Panen Valid</div>
            <div class="stat-value">{{ number_format($totalPanen, 1) }}</div>
            <div class="stat-unit">Kilogram</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Jumlah Laporan</div>
            <div class="stat-value">{{ $jumlahLaporan }}</div>
            <div class="stat-unit">Laporan</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Rata-rata Per Laporan</div>
            <div class="stat-value">{{ $jumlahLaporan > 0 ? number_format($totalPanen / $jumlahLaporan, 1) : '0' }}</div>
            <div class="stat-unit">Kg / Laporan</div>
        </div>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:4%" class="center">No</th>
                    <th style="width:15%">Tanggal Panen</th>
                    <th style="width:25%">Nama Petugas</th>
                    <th style="width:18%" class="center">Jumlah (Kg)</th>
                    <th style="width:18%" class="center">Kondisi Jamur</th>
                    <th style="width:20%" class="center">Status</th>
                </tr>
            </thead>
            <tbody>
            @forelse($reports as $i => $r)
                <tr>
                    <td class="center">{{ $i + 1 }}</td>
                    <td class="bold">{{ optional($r->tanggal)->isoFormat('D MMM Y') ?: $r->tanggal }}</td>
                    <td>{{ optional($r->user)->name ?: '-' }}</td>
                    <td class="num">{{ number_format($r->jumlah_panen, 1) }} Kg</td>
                    <td class="center"><span class="badge-kondisi">{{ $r->kualitas_panen }}</span></td>
                    <td class="center"><span class="badge-valid">✓ Valid</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="center" style="padding: 20px; color: #94a3b8;">
                        Tidak ada data laporan yang tervalidasi.
                    </td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align:right; padding-right:12px;">TOTAL KESELURUHAN</td>
                    <td class="center">{{ number_format($totalPanen, 1) }} Kg</td>
                    <td class="center">{{ $jumlahLaporan }} Laporan</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="footer">
        <div>
            Dokumen ini digenerate secara otomatis oleh Sistem Informasi KUPS Harapan Asri.<br>
            Laporan berlaku tanpa tanda tangan jika dicetak dari sistem.
        </div>
        <div class="signature">
            <div>Sijunjung, {{ now()->isoFormat('D MMMM Y') }}</div>
            <div class="line"></div>
            <div style="font-weight: bold; color: #1e293b;">Ketua KUPS Harapan Asri</div>
        </div>
    </div>

</body>
</html>
