<?php

namespace App\Livewire\Document;

use App\Models\Profile;
use App\Models\Report;
use App\Models\ReportBudgetRealization;
use App\Models\ReportCommittee;
use App\Models\ReportEvaluation;
use App\Models\ReportFile;
use App\Models\ReportIntroduction;
use App\Models\ReportPlanActivity;
use App\Models\ReportSchedule;
use App\Services\PDFReportService;
use App\Services\WordReportService;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Title;
use Livewire\Component;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class ModifyReport extends Component
{
    #[Title('Modify Laporan Kegiatan')]

    public $id, $judul, $kutipan, $kata_pengantar, $penutup, $press_release;
    public $report, $introduction, $planActivities, $schedules, $budgetRealizations, $committee, $evaluation, $documentations, $attendances, $receipts, $my;

    public function mount($id)
    {
        $this->id = $id;
        $this->report = Report::findOrFail($id);
        $this->judul = $this->report->judul;
        $this->kutipan = $this->report->kutipan;
        $this->kata_pengantar = $this->report->kata_pengantar;
        $this->penutup = $this->report->penutup;
        $this->press_release = $this->report->press_release;

        $this->introduction = ReportIntroduction::where('laporan_id', $id)->first();
        $this->planActivities = ReportPlanActivity::where('laporan_id', $id)->first();
        $this->schedules = ReportSchedule::where('laporan_id', $id)->get();
        $this->budgetRealizations = ReportBudgetRealization::where('laporan_id', $id)->get();
        $this->committee = ReportCommittee::where('laporan_id', $id)->first();
        $this->evaluation = ReportEvaluation::where('laporan_id', $id)->first();
        $this->documentations = ReportFile::where('laporan_id', $id)->where('type', 'documentation')->get();
        $this->attendances = ReportFile::where('laporan_id', $id)->where('type', 'attendance')->get();
        $this->receipts = ReportFile::where('laporan_id', $id)->where('type', 'receipt')->get();
        $this->my = Profile::first();
    }

    public function updated($property)
    {
        $this->report->update([
            $property => $this->$property
        ]);
    }

    public function createPDFDocument()
    {
        return PDFReportService::print();
    }

    public function createWordDocument()
    {
        return WordReportService::print(
            $this->report,
            $this->introduction,
            $this->planActivities,
            $this->schedules,
            $this->budgetRealizations,
            $this->committee,
            $this->evaluation,
            $this->documentations,
            $this->attendances,
            $this->receipts,
            $this->my,
        );
    }

    public function createWordDocuments()
    {
        require_once(public_path('jpgraph/src/jpgraph.php'));
        require_once(public_path('jpgraph/src/jpgraph_pie.php'));

        // Pastikan folder 'public/charts/' ada
        File::ensureDirectoryExists(public_path('charts'));

        // Path penyimpanan file PNG
        $imagePath = public_path('charts/pie_chart.png');

        // Jika file lama ada, hapus dulu untuk memastikan warna berubah
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Data untuk Pie Chart
        $data = [40, 30, 20, 10];

        // Buat objek grafik
        $graph = new \PieGraph(400, 300);
        $graph->title->Set("Contoh Pie Chart");
        $graph->SetShadow();

        // Buat Pie Plot
        $pie = new \PiePlot($data);
        $pie->SetLegends(["A", "B", "C", "D"]);

        // Warna potongan pie chart dengan format HEX (string)
        $colors = ['red', 'black', 'green', 'blue'];
        $pie->SetSliceColors($colors);

        // Menampilkan persentase di dalam potongan pie
        $pie->SetLabelType(\PIE_VALUE_PER);
        $pie->value->SetFormat('%2.1f%%'); // Format persentase (40.0%, 30.0%, dll)
        $pie->value->SetColor("white"); // Warna teks persentase putih
        $pie->SetLabelPos(0.5); // Posisi label di tengah

        $graph->Add($pie);

        // Simpan gambar ke folder 'public/charts/'
        $graph->Stroke($imagePath);

        // Tunggu sampai gambar benar-benar sudah di-generate
        sleep(1); // Menunggu 1 detik

        // Verifikasi bahwa file gambar sudah ada dan memiliki ukuran yang benar
        if (file_exists($imagePath) && filesize($imagePath) > 0) {
            // Buat objek PHPWord
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $section = $phpWord->addSection();

            // Tambahkan judul ke Word
            $section->addText('Laporan Pie Chart', ['bold' => true, 'size' => 16]);

            // Tambahkan gambar ke Word dengan ukuran dan alignment yang sesuai
            $section->addImage($imagePath, [
                'width' => 400,
                'height' => 300,
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
            ]);

            // Simpan dokumen Word di 'public/charts/'
            $fileName = 'Laporan_Pie_Chart.docx';
            $filePath = public_path('charts/' . $fileName);
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($filePath);

            // Hapus gambar setelah masuk ke Word
            unlink($imagePath);

            // Kirim file Word dan hapus setelah di-download
            return response()->download($filePath)->deleteFileAfterSend(true);
        } else {
            return response()->json(['error' => 'Failed to generate chart image'], 500);
        }
    }

    public function render()
    {
        return view('livewire.document.modify-report');
    }
}
