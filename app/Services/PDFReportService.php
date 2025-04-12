<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class PDFReportService
{
    public static function print(
        $report,
        $introduction,
        $planActivity,
        $schedules,
        $budgetRealizations,
        $committee,
        $evaluation,
        $documentations,
        $attendances,
        $receipts,
        $date,
    ) {
        $roles = ['penasehat', 'pembina', 'penanggung_jawab', 'ketua_pelaksana', 'moderator', 'publikasi_media', 'sie_konsumsi', 'sie_registrasi', 'dokumentasi', 'sosialisasi', 'multimedia', 'perlengkapan'];

        $titles = ['Penasehat:', 'Pembina:', 'Penanggung Jawab:', 'Ketua Pelaksana:', 'Moderator:', 'Publikasi dan Media:', 'Sie Konsumsi:', 'Sie Registrasi:', 'Dokumentasi:', 'Sosialisasi Beasiswa UBSI:', 'Multimedia:', 'Perlengkapan:'];

        $pdf = Pdf::loadView('pdf.laporan', [
            'report' => $report,
            'introduction' => $introduction,
            'planActivity' => $planActivity,
            'schedules' => $schedules,
            'budgetRealizations' => $budgetRealizations,
            'committee' => $committee,
            'evaluation' => $evaluation,
            'documentations' => $documentations,
            'attendances' => $attendances,
            'receipts' => $receipts,
            'date' => $date,
            'pieChart1' => self::generatePieChart($evaluation)[0],
            'pieChart2' => self::generatePieChart($evaluation)[1],
            'pieChart3' => self::generatePieChart($evaluation)[2],
            'roles' => $roles,
            'titles' => $titles
        ]);
        $title = " " . $report->judul ?? 'Tak Berjudul';

        return response()->streamDownload(
            function () use ($pdf) {
                echo $pdf->output();
            },
            "Dokumen{$title}.pdf"
        );
    }

    public static function generatePieChart($evaluation)
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
