<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\Models\ProductionReport;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

class KetuaDashboardController extends Controller
{
    /**
     * Tampilkan dashboard Ketua KUPS dengan ringkasan statistik dan data grafik.
     */
    public function index(): View
    {
        // 1. Ringkasan Data Produksi (hanya laporan yang sudah divalidasi 'valid')
        $totalProduksi     = ProductionReport::where('status_validasi', 'valid')->sum('berat_grade_a');
        $totalPanenGagal   = ProductionReport::where('status_validasi', 'valid')->sum('berat_grade_b');
        $totalLaporanValid = ProductionReport::where('status_validasi', 'valid')->count();
        $rataRataPanen     = ProductionReport::where('status_validasi', 'valid')->avg('jumlah_panen') ?? 0;

        // 2. Data Grafik: Total panen per bulan untuk 12 bulan terakhir
        $chartData = ProductionReport::select(
                DB::raw("DATE_FORMAT(tanggal, '%M %Y') as bulan"),
                DB::raw("SUM(berat_grade_a) as total_berhasil"),
                DB::raw("SUM(berat_grade_b) as total_gagal")
            )
            ->where('status_validasi', 'valid')
            ->groupBy('bulan')
            ->orderBy(DB::raw('MIN(tanggal)'), 'asc')
            ->take(12)
            ->get();

        // 3. Format label dan nilai untuk Chart.js
        $chartLabels = $chartData->pluck('bulan')->toArray();
        $chartValuesBerhasil = $chartData->pluck('total_berhasil')->toArray();
        $chartValuesGagal = $chartData->pluck('total_gagal')->toArray();

        // 4. Log laporan terbaru (semua status)
        $recentReports = ProductionReport::with('user')
            ->orderBy('tanggal', 'desc')
            ->take(10)
            ->get();

        // Pipeline Production Indicators
        $pipelineStokBaglog = \App\Models\Baglog::doesntHave('sterilisasis')->count();
        $pipelinePendinginan = \App\Models\Sterilisasi::doesntHave('inokulasis')->whereDate('tanggal', today())->count();
        $pipelineSiapInokulasi = \App\Models\Sterilisasi::doesntHave('inokulasis')->whereDate('tanggal', '<', today())->count();
        $pipelineInkubasi = \App\Models\Inokulasi::whereDoesntHave('logInkubasis', function ($q) {
            $q->where('persentase_tumbuh', 100);
        })->count();
        $pipelineSiapPanen = \App\Models\Inokulasi::where(function ($q) {
            $q->whereHas('logInkubasis', function ($q2) {
                $q2->where('persentase_tumbuh', 100);
            })->orWhere('tanggal', '<=', now()->subDays(40));
        })->count();

        return view('ketua.dashboard', compact(
            'totalProduksi',
            'totalPanenGagal',
            'totalLaporanValid',
            'rataRataPanen',
            'chartLabels',
            'chartValuesBerhasil',
            'chartValuesGagal',
            'recentReports',
            'pipelineStokBaglog',
            'pipelinePendinginan',
            'pipelineSiapInokulasi',
            'pipelineInkubasi',
            'pipelineSiapPanen'
        ));
    }

    /**
     * Ekspor laporan yang sudah divalidasi sebagai PDF menggunakan DomPDF.
     */
    public function exportPdf()
    {
        $reports = ProductionReport::with('user')
            ->where('status_validasi', 'valid')
            ->orderBy('tanggal', 'asc')
            ->get();

        $totalPanen = $reports->sum('jumlah_panen');
        $jumlahLaporan = $reports->count();
        $tanggalCetak = now()->isoFormat('D MMMM Y, HH:mm');

        $pdf = Pdf::loadView('ketua.reports.pdf', compact(
            'reports',
            'totalPanen',
            'jumlahLaporan',
            'tanggalCetak'
        ));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('Laporan_Panen_KUPS_' . now()->format('Ymd') . '.pdf');
    }

    /**
     * Ekspor laporan ke format Excel (.xlsx) menggunakan PhpSpreadsheet.
     */
    public function exportExcel()
    {
        $reports = ProductionReport::with('user')
            ->where('status_validasi', 'valid')
            ->orderBy('tanggal', 'asc')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Panen');

        // === HEADER JUDUL ===
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'LAPORAN PANEN KUPS HARAPAN ASRI');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0d7844']],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Sub-judul tanggal cetak
        $sheet->mergeCells('A2:F2');
        $sheet->setCellValue('A2', 'Dicetak: ' . now()->isoFormat('D MMMM Y, HH:mm') . ' | Status: Tervalidasi');
        $sheet->getStyle('A2')->applyFromArray([
            'font' => ['italic' => true, 'size' => 10, 'color' => ['rgb' => '555555']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'e6f4ee']],
        ]);
        $sheet->getRowDimension(2)->setRowHeight(18);

        // Baris kosong
        $sheet->getRowDimension(3)->setRowHeight(5);

        // === HEADER KOLOM ===
        $headers = ['No', 'Tanggal Panen', 'Nama Petugas', 'Jumlah Panen (Kg)', 'Grade A / B (Kg)', 'Status Validasi'];
        $headerCols = ['A', 'B', 'C', 'D', 'E', 'F'];

        foreach ($headers as $i => $header) {
            $col = $headerCols[$i];
            $sheet->setCellValue($col . '4', $header);
        }

        $sheet->getStyle('A4:F4')->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0a5e35']],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '088a4b']]],
        ]);
        $sheet->getRowDimension(4)->setRowHeight(22);

        // === DATA ROWS ===
        $row = 5;
        $no = 1;
        foreach ($reports as $r) {
            $isEven = ($no % 2 === 0);
            $bgColor = $isEven ? 'f0faf5' : 'ffffff';

            $tanggal = optional($r->tanggal)->format('d-m-Y') ?: $r->tanggal;
            $petugas = optional($r->user)->name ?: '-';

            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $tanggal);
            $sheet->setCellValue('C' . $row, $petugas);
            $sheet->setCellValue('D' . $row, (float) $r->jumlah_panen);
            $sheet->setCellValue('E' . $row, (float) $r->berat_grade_a . ' / ' . (float) $r->berat_grade_b);
            $sheet->setCellValue('F' . $row, 'Valid ✓');

            $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray([
                'font' => ['size' => 10],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $bgColor]],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'c7e8d5']]],
            ]);

            // Angka tengah
            $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('D' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('F' . $row)->applyFromArray([
                'font' => ['bold' => true, 'color' => ['rgb' => '0d7844']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);

            $sheet->getRowDimension($row)->setRowHeight(18);
            $row++;
            $no++;
        }

        // === BARIS TOTAL ===
        $sheet->mergeCells('A' . $row . ':C' . $row);
        $sheet->setCellValue('A' . $row, 'TOTAL KESELURUHAN');
        $sheet->setCellValue('D' . $row, $reports->sum('jumlah_panen'));
        $sheet->setCellValue('E' . $row, $reports->count() . ' laporan');

        $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0d7844']],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '088a4b']]],
        ]);
        $sheet->getRowDimension($row)->setRowHeight(22);

        // === LEBAR KOLOM ===
        $sheet->getColumnDimension('A')->setWidth(6);
        $sheet->getColumnDimension('B')->setWidth(18);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(18);
        $sheet->getColumnDimension('F')->setWidth(18);

        // === OUTPUT SEBAGAI FILE XLSX ===
        $filename = 'Laporan_Panen_KUPS_' . now()->format('Ymd_His') . '.xlsx';

        $writer = new Xlsx($spreadsheet);

        return FacadeResponse::streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    /**
     * Tampilkan halaman indeks laporan untuk Ketua (lihat + unduh).
     */
    public function reports()
    {
        $reports = ProductionReport::with('user')
            ->orderBy('tanggal', 'desc')
            ->get();

        $totalValid   = $reports->where('status_validasi', 'valid')->count();
        $totalPending = $reports->where('status_validasi', 'pending')->count();
        $totalPanen   = $reports->where('status_validasi', 'valid')->sum('jumlah_panen');

        return view('ketua.reports.index', compact('reports', 'totalValid', 'totalPending', 'totalPanen'));
    }

    /**
     * Tampilkan versi printable (preview) tanpa mendownload.
     */
    public function printable()
    {
        $reports = ProductionReport::with('user')
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('ketua.reports.printable', compact('reports'));
    }

    /**
     * TRACEABILITY: Melacak riwayat hulu-hilir suatu batch baglog
     */
    public function lacakBatch($baglog_id)
    {
        // 1. Ambil data Baglog
        $baglog = \App\Models\Baglog::with('user')->findOrFail($baglog_id);

        // 2. Ambil data Sterilisasi yang terkait dengan baglog ini
        $sterilisasi = \App\Models\Sterilisasi::where('baglog_id', $baglog_id)->with('user')->first();

        $inokulasi = null;
        $monitoring = null;
        $panen = null;

        if ($sterilisasi) {
            // 3. Ambil Inokulasi dari sterilisasi tersebut
            $inokulasi = \App\Models\Inokulasi::where('sterilisasi_id', $sterilisasi->id)->with('user')->first();
            
            if ($inokulasi) {
                // 4. Ambil Riwayat Monitoring (Bisa lebih dari 1, kita ambil listnya)
                $monitoring = \App\Models\MonitoringKumbung::where('inokulasi_id', $inokulasi->id)->with('user')->orderBy('tanggal', 'desc')->get();
                
                // 5. Ambil Laporan Panen dari batch inokulasi ini
                $panen = \App\Models\ProductionReport::where('inokulasi_id', $inokulasi->id)->with('user')->get();
            }
        }

        // 6. Return ke view investigasi (Traceability)
        return view('ketua.traceability.detail', compact(
            'baglog', 
            'sterilisasi', 
            'inokulasi', 
            'monitoring', 
            'panen'
        ));
    }

    /**
     * TRACEABILITY: Halaman Index pencarian batch
     */
    public function traceabilityIndex()
    {
        $baglogs = \App\Models\Baglog::with('user')->orderBy('tanggal_pembuatan', 'desc')->get();
        return view('ketua.traceability.index', compact('baglogs'));
    }

    /**
     * VERIFIKASI: Halaman Index laporan panen pending
     */
    public function verifikasiIndex()
    {
        $reports = \App\Models\ProductionReport::with('user', 'inokulasi.sterilisasi.baglog')
            ->orderBy('status_validasi', 'asc') // Munculkan pending terlebih dahulu
            ->orderBy('tanggal', 'desc')
            ->get();
            
        return view('ketua.verifikasi.index', compact('reports'));
    }

    /**
     * VERIFIKASI: Proses terima / tolak laporan
     */
    public function validateReport(\Illuminate\Http\Request $request, $id)
    {
        $report = \App\Models\ProductionReport::findOrFail($id);
        
        $request->validate([
            'status_validasi' => 'required|in:valid,invalid',
            'catatan' => 'nullable|string'
        ]);

        $report->status_validasi = $request->status_validasi;
        $report->validated_by = auth()->id();
        
        // Append atau Replace catatan
        if ($request->catatan) {
            $report->catatan = ($report->catatan ? $report->catatan . "\n[Ketua]: " : "[Ketua]: ") . $request->catatan;
        }

        $report->save();

        return redirect()->route('ketua.verifikasi.index')
            ->with('success', 'Status validasi laporan panen berhasil diperbarui!');
    }
}
