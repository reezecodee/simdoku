<?php

namespace App\Http\Controllers\Preview;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportBudgetRealization;
use App\Models\ReportCommittee;
use App\Models\ReportEvaluation;
use App\Models\ReportFile;
use App\Models\ReportIntroduction;
use App\Models\ReportPlanActivity;
use App\Models\ReportSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ReportPreviewController extends Controller
{
    public function preview($id)
    {
        $report = Report::findOrFail($id);
        $introduction = ReportIntroduction::where('laporan_id', $id)->first();
        $planActivity = ReportPlanActivity::where('laporan_id', $id)->first();
        $schedules = ReportSchedule::where('laporan_id', $id)->get();
        $budgetRealizations = ReportBudgetRealization::where('laporan_id', $id)->get();
        $committee = ReportCommittee::where('laporan_id', $id)->first();
        $evaluation = ReportEvaluation::where('laporan_id', $id)->first();
        $documentations = ReportFile::where('laporan_id', $id)->where('type', 'documentation')->get();
        $attendances = ReportFile::where('laporan_id', $id)->where('type', 'attendance')->get();
        $receipts = ReportFile::where('laporan_id', $id)->where('type', 'receipt')->get();
        $date = Carbon::now()->translatedFormat('d F Y');
        $pieChart1 = $this->generatePieChart($evaluation)[0];
        $pieChart2 = $this->generatePieChart($evaluation)[1];
        $pieChart3 = $this->generatePieChart($evaluation)[2];
        $roles = ['penasehat', 'pembina', 'penanggung_jawab', 'ketua_pelaksana', 'moderator', 'publikasi_media', 'sie_konsumsi', 'sie_registrasi', 'dokumentasi', 'sosialisasi', 'multimedia', 'perlengkapan'];
        $titles = ['Penasehat:', 'Pembina:', 'Penanggung Jawab:', 'Ketua Pelaksana:', 'Moderator:', 'Publikasi dan Media:', 'Sie Konsumsi:', 'Sie Registrasi:', 'Dokumentasi:', 'Sosialisasi Beasiswa UBSI:', 'Multimedia:', 'Perlengkapan:'];

        return view('preview.laporan', compact(
            'report',
            'introduction',
            'planActivity',
            'schedules',
            'budgetRealizations',
            'committee',
            'evaluation',
            'documentations',
            'attendances',
            'receipts',
            'date',
            'pieChart1',
            'pieChart2',
            'pieChart3',
            'roles',
            'titles',
        ));
    }

    private function generatePieChart($evaluation)
    {
        require_once(public_path('jpgraph/src/jpgraph.php'));
        require_once(public_path('jpgraph/src/jpgraph_pie.php'));

        File::ensureDirectoryExists(public_path('charts'));

        foreach (['pie1.png', 'pie2.png', 'pie3.png'] as $file) {
            $filePath = public_path("charts/$file");
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $dataSets = [
            [
                (int) ($evaluation->siswa ?? 0),
                (int) ($evaluation->guru ?? 0),
                (int) ($evaluation->mahasiswa ?? 0),
                (int) ($evaluation->masyarakat_umum ?? 0),
            ],
            [
                (int) ($evaluation->peserta_puas ?? 0),
                (int) ($evaluation->peserta_cukup_puas ?? 0),
                (int) ($evaluation->peserta_tidak_puas ?? 0),
            ],
            [
                (int) ($evaluation->penilaian_sangat_bagus ?? 0),
                (int) ($evaluation->penilaian_cukup_bagus ?? 0),
                (int) ($evaluation->penilaian_kurang_bagus ?? 0),
            ],
        ];

        $legends = [
            ["Siswa", "Guru", "Mahasiswa", "Umum"],
            ["Puas", "Cukup Puas", "Tidak Puas"],
            ["Sangat Bagus", "Cukup Bagus", "Kurang Bagus"],
        ];

        $imagePaths = [];

        foreach ($dataSets as $index => $data) {
            $imagePath = public_path("charts/pie" . ($index + 1) . ".png");
            $imagePaths[] = $imagePath;

            $graph = new \PieGraph(420, 250);
            $graph->SetShadow();

            $pie = new \PiePlot($data);
            $pie->SetLegends($legends[$index]);

            $pie->SetLabelType(\PIE_VALUE_PER);
            $pie->value->SetFormat('%2.1f%%');
            $pie->value->SetColor("white");
            $pie->SetSize(0.4);
            $pie->SetLabelPos(0.6);

            $graph->Add($pie);
            $graph->legend->SetPos(0.5, 0.98, 'center', 'bottom');
            $graph->Stroke($imagePath);
        }

        return $imagePaths;
    }
}
