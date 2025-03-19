<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\Table;

class WordReportService
{
    public static function print(
        $report,
        $introduction,
        $planActivities,
        $schedules,
        $budgetRealizations,
        $committee,
        $evaluation,
        $documentations,
        $attendances,
        $receipts,
        $my,
        $date
    ) {
        $phpWord = self::init();

        $phpWord = self::cover($phpWord, $report);
        $phpWord = self::foreword($phpWord, $report);
        $phpWord = self::TOC($phpWord);
        $phpWord = self::introduction($phpWord, $introduction);
        $phpWord = self::implementationActivity($phpWord, $planActivities, $schedules, $budgetRealizations, $committee, $evaluation);
        $phpWord = self::closing($phpWord, $report, $my, $date);
        $phpWord = self::attachments($phpWord, $report, $documentations, $attendances, $receipts);

        return self::output($phpWord);
    }

    private static function init()
    {
        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);
        $phpWord->setDefaultParagraphStyle([
            'indentation' => ['firstLine' => 480],
            'alignment' => Jc::BOTH,
            'lineHeight' => 1.5,
            'spaceAfter' => 120,
        ]);

        $phpWord->addTitleStyle(
            1,
            ['bold' => true, 'size' => 14],
            [
                'alignment' => Alignment::HORIZONTAL_CENTER,
                'indentation' => ['firstLine' => 0]
            ]
        );
        $phpWord->addTitleStyle(
            2,
            ['bold' => true, 'size' => 12],
            [
                'alignment' => Alignment::HORIZONTAL_LEFT,
                'indentation' => ['firstLine' => 0]
            ]
        );

        return $phpWord;
    }

    private static function output($phpWord)
    {
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

        $fileName = 'laporan.docx';
        $imagePaths = self::generatePieChart();

        return response()->stream(
            function () use ($objWriter, $imagePaths) {
                $objWriter->save('php://output');
                foreach ($imagePaths as $imagePath) {
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Pragma' => 'public',
                'Expires' => '0',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            ]
        );

        return $response;
    }

    private static function generatePieChart()
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
            [$evaluation->siswa ?? 1, $evaluation->guru ?? 1, $evaluation->mahasiswa ?? 1, $evaluation->masyarakat_umum ?? 1],
            [$evaluation->peserta_puas ?? 1, $evaluation->peserta_cukup_puas ?? 1, $evaluation->peserta_tidak_puas ?? 1],
            [$evaluation->penilaian_sangat_bagus ?? 1, $evaluation->penilaian_cukup_bagus ?? 1, $evaluation->penilaian_kurang_bagus ?? 1],
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

    private static function cover($phpWord, $report)
    {
        $section = $phpWord->addSection();
        $section->addText('LAPORAN', ['bold' => true, 'size' => 20], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        $section->addText($report->judul, ['bold' => true, 'size' => 20], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        if ($report->kutipan) {
            $section->addText("“{$report->kutipan}”", ['bold' => true, 'size' => 12], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        }

        $section->addTextBreak(3);
        $imagePath = public_path('images/logo/logo-bsi.png');
        if (file_exists($imagePath)) {
            $section->addImage($imagePath, [
                'alignment' => Alignment::VERTICAL_CENTER,
                'width' => 150,
                'height' => 150,
            ]);
        }
        $section->addTextBreak(6);

        $section->addText('UNIVERSITAS BINA SARANA INFORMATIKA', ['bold' => true, 'size' => 14], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        $section->addText('PSDKU TASIKMALAYA', ['bold' => true, 'size' => 14], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        $section->addText(date('Y'), ['bold' => true, 'size' => 14], ['alignment' => Alignment::HORIZONTAL_CENTER]);

        return $phpWord;
    }

    private static function foreword($phpWord, $report)
    {
        $section = $phpWord->addSection();
        $section->addTitle('KATA PENGANTAR', 1);
        Html::addHtml($section, paragraph($report->kata_pengantar), false, false);

        return $phpWord;
    }

    private static function TOC($phpWord)
    {
        $section = $phpWord->addSection();
        $section->addTitle('DAFTAR ISI', 1);

        return $phpWord;
    }

    private static function introduction($phpWord, $introduction)
    {
        $section = $phpWord->addSection();
        $section->addTitle("BAB I", 1);
        $section->addTitle("PENDAHULUAN", 1);
        $section->addTitle('1.1 Latar Belakang', 2);
        Html::addHtml($section, paragraph($introduction->latar_belakang), false, false);

        $section->addTitle('1.2 Tujuan Kegiatan', 2);
        Html::addHtml($section, paragraph($introduction->tujuan_kegiatan), false, false);

        $section->addTitle('1.3 Manfaat Kegiatan', 2);
        Html::addHtml($section, paragraph($introduction->manfaat_kegiatan), false, false);

        $section->addTitle('1.4 Indikator Keberhasilan', 2);
        Html::addHtml($section, paragraph($introduction->indikator_keberhasilan), false, false);

        return $phpWord;
    }

    private static function implementationActivity($phpWord, $planActivities, $schedules, $budgetRealizations, $committee, $evaluation)
    {
        $section = $phpWord->addSection();
        $section->addTitle("BAB II", 1);
        $section->addTitle("PERENCANAAN KEGIATAN", 1);

        $section->addTitle('2.1 Nama dan Tema Kegiatan', 2);
        Html::addHtml($section, paragraph($planActivities->tema_kegiatan), false, false);

        $section->addTitle('2.2 Deskripsi Kegiatan', 2);
        Html::addHtml($section, paragraph($planActivities->deskripsi_kegiatan), false, false);

        $section->addTitle('2.3 Penyelenggara Kegiatan', 2);
        Html::addHtml($section, paragraph($planActivities->penyelenggara_kegiatan), false, false);

        $section->addTitle('2.4 Pemateri atau Narasumber', 2);
        Html::addHtml($section, paragraph($planActivities->pemateri_narasumber), false, false);

        $section->addTitle('2.5 Peserta Kegiatan', 2);
        Html::addHtml($section, paragraph($planActivities->peserta_kegiatan), false, false);

        $section->addTitle('2.6 Waktu Pelaksanaan', 2);
        Html::addHtml($section, paragraph($planActivities->waktu_pelaksanaan), false, false);

        $section->addTitle('2.7 Evaluasi Kegiatan', 2);
        $section->addText("a. Jumlah Peserta", ['bold' => true]);
        $section->addText("- Jumlah peserta daftar : {$evaluation->peserta_daftar} Orang");
        $section->addText("- Jumlah peserta hadir : {$evaluation->peserta_hadir} Orang peserta");

        $section->addImage(self::generatePieChart()[0], [
            'alignment' => Jc::CENTER,
            'width' => 420,
            'height' => 250,
        ]);

        $section->addText("b. Kepuasan Peserta", ['bold' => true]);
        $section->addImage(self::generatePieChart()[1], [
            'alignment' => Jc::CENTER,
            'width' => 420,
            'height' => 250,
        ]);

        $section->addText("c. Penilaian Tentang Acara", ['bold' => true]);
        $section->addImage(self::generatePieChart()[2], [
            'alignment' => Jc::CENTER,
            'width' => 420,
            'height' => 250,
        ]);

        $tableStyle = [
            'borderSize' => 6,
            'borderColor' => '000000',
            'alignment' => Jc::CENTER,
            'layout' => Table::LAYOUT_FIXED,
            'cellMargin' => 100,
        ];

        $phpWord->addParagraphStyle('TableHeaderStyle', [
            'indentation' => ['firstLine' => 0],
            'alignment' => Jc::CENTER
        ]);

        $phpWord->addParagraphStyle('TableCellStyle', [
            'indentation' => ['firstLine' => 0],
        ]);

        $phpWord->addTableStyle('CustomTable', $tableStyle);

        $headerStyle = ['bgColor' => 'D9D9D9'];

        if ($schedules->isNotEmpty()) {
            $section->addTitle('2.8 Susunan Acara', 2);
            $table = $section->addTable('CustomTable');

            $table->addRow();
            $table->addCell(1000, $headerStyle)->addText("NO", ['bold' => true], 'TableHeaderStyle');
            $table->addCell(2000, $headerStyle)->addText("WAKTU", ['bold' => true], 'TableCellStyle');
            $table->addCell(4000, $headerStyle)->addText("Sub Acara", ['bold' => true], 'TableCellStyle');
            $table->addCell(5000, $headerStyle)->addText("KETERANGAN", ['bold' => true], 'TableCellStyle');

            $no = 1;
            foreach ($schedules as $item) {
                $table->addRow();
                $table->addCell(1000)->addText($no, [], 'TableHeaderStyle');
                $table->addCell(2000)->addText($item->waktu, [], 'TableCellStyle');
                $table->addCell(4000)->addText($item->sub_acara, [], 'TableCellStyle');
                $table->addCell(5000)->addText($item->keterangan, [], 'TableCellStyle');
                $no++;
            }
            $section->addTextBreak(1);
        }


        if ($committee) {
            $section->addTitle('2.9 Susunan Panitia', 2);
            $table = $section->addTable([
                'borderSize' => 0,
                'borderColor' => 'FFFFFF'
            ]);

            $roles = ['penasehat', 'pembina', 'penanggung_jawab', 'ketua_pelaksana', 'moderator', 'publikasi_media', 'sie_konsumsi', 'sie_registrasi', 'dokumentasi', 'sosialisasi', 'multimedia', 'perlengkapan'];

            $titles = ['Penasehat', 'Pembina', 'Penanggung Jawab', 'Ketua Pelaksana', 'Moderator', 'Publikasi & Media', 'Sie Konsumsi', 'Sie Registrasi', 'Dokumentasi', 'Sosialisasi Beasiswa UBSI', 'Multimedia', 'Perlengkapan'];

            $no = 1;
            foreach ($roles as $role) {
                if ($committee->$role) {
                    $table->addRow();
                    $table->addCell(1000)->addText($titles[$no], [], 'TableHeaderStyle');
                    $table->addCell(8000)->addText($committee->$role, [], 'TableCellStyle');
                    $no++;
                }
            }

            $section->addTextBreak(1);
        }


        if ($budgetRealizations->isNotEmpty()) {
            $section->addTitle('2.10 Realisasi Anggaran', 2);
            $table = $section->addTable('CustomTable');

            $table->addRow();
            $table->addCell(6000, $headerStyle)->addText("Anggaran", ['bold' => true], 'TableHeaderStyle');
            $table->addCell(2000, $headerStyle)->addText("Jumlah", ['bold' => true], 'TableHeaderStyle');
            $table->addCell(3000, $headerStyle)->addText("(Rupiah)", ['bold' => true], 'TableHeaderStyle');

            $total = idr($budgetRealizations->sum('rupiah'));

            foreach ($budgetRealizations as $item) {
                $table->addRow();
                $table->addCell(6000)->addText($item->anggaran, [], 'TableCellStyle');
                $table->addCell(2000)->addText($item->jumlah, [], 'TableHeaderStyle');
                $table->addCell(3000)->addText(idr($item->rupiah), [], 'TableCellStyle');
            }

            $table->addRow();
            $table->addCell(8000, ['gridSpan' => 2])->addText("Total pengeluaran", ['bold' => true, 'italic' => true, 'alignment' => 'center'], 'TableHeaderStyle');
            $table->addCell(3000)->addText($total, ['bold' => true], 'TableHeaderStyle');

            $section->addTextBreak(1);
        }

        return $phpWord;
    }

    private static function closing($phpWord, $report, $my, $date)
    {
        $section = $phpWord->addSection();
        $section->addTitle("BAB III", 1);
        $section->addTitle("PENUTUP", 1);
        Html::addHtml($section, paragraph($report->penutup), false, false);
        $section->addText("Tasikmalaya, {$date}", [], [
            'alignment' => Jc::CENTER,
            'indentation' => ['firstLine' => 0]
        ]);
        $section->addTextBreak(1);
        $section->addText("Hormat Kami,", [], [
            'alignment' => Jc::CENTER,
            'indentation' => ['firstLine' => 0]
        ]);

        $tableStyle = [
            'alignment' => Jc::CENTER,
            'cellMargin' => 0,
        ];

        $table = $section->addTable($tableStyle);

        $table->addRow();
        $cell1 = $table->addCell(5000);
        $cell2 = $table->addCell(5000);

        $cell1->addText(
            "Mengetahui,",
            [],
            ['alignment' => Jc::CENTER, 'indentation' => 0]
        );
        $cell2->addText(
            "Pelaksana,",
            [],
            ['alignment' => Jc::CENTER, 'indentation' => 0]
        );

        $table->addRow();
        $cell1 = $table->addCell(5000);
        $cell2 = $table->addCell(5000);

        $cell1->addImage(storage_path('app/public/' . $my->tanda_tangan), [
            'width' => 110,
            'height' => 50,
            'alignment' => Jc::CENTER
        ]);
        $cell2->addImage(storage_path('app/public/' . $report->signature->tanda_tangan), [
            'width' => 110,
            'height' => 50,
            'alignment' => Jc::CENTER
        ]);

        $table->addRow();
        $cell1 = $table->addCell(5000);
        $cell2 = $table->addCell(5000);

        $cell1->addText(
            $my->nama,
            ['underline' => 'single'],
            ['alignment' => Jc::CENTER, 'indentation' => 0]
        );
        $cell2->addText(
            $report->signature->nama_pemilik,
            ['underline' => 'single'],
            ['alignment' => Jc::CENTER, 'indentation' => 0]
        );

        $table->addRow();
        $cell1 = $table->addCell(5000);
        $cell2 = $table->addCell(5000);

        $cell1->addText(
            "Ketua Pelaksana",
            ['bold' => true],
            ['alignment' => Jc::CENTER, 'indentation' => 0]
        );
        $cell2->addText(
            "Kepala Kampus UBSI Tasikmalaya",
            ['bold' => true],
            ['alignment' => Jc::CENTER, 'indentation' => 0]
        );

        $section->addTextBreak(1);

        $table = $section->addTable($tableStyle);

        $table->addRow();
        $cell1 = $table->addCell(5000);

        $cell1->addText(
            "Menyetujui,",
            [],
            ['alignment' => Jc::CENTER, 'indentation' => 0]
        );

        $table->addRow();
        $cell1 = $table->addCell(5000);

        $cell1->addText("", [], ['align' => 'center', 'indentation' => 0]);
        $cell1->addText("", [], ['align' => 'center', 'indentation' => 0]);

        $table->addRow();
        $cell1 = $table->addCell(5000);

        $cell1->addText(
            $report->signature2->nama_pemilik,
            ['underline' => 'single'],
            ['alignment' => Jc::CENTER, 'indentation' => 0]
        );

        $table->addRow();
        $cell1 = $table->addCell(10000);

        $cell1->addText(
            "Kadiv DMER Universitas Bina Sarana Informatika",
            ['bold' => true],
            ['alignment' => Jc::CENTER, 'indentation' => 0]
        );

        return $phpWord;
    }

    private static function attachments($phpWord, $report, $documentations, $attendances, $receipts)
    {
        $section = $phpWord->addSection();

        $section->addTitle('Lampiran-lampiran', 2);
        $section->addText("1. Press Release");
        Html::addHtml($section, $report->press_release, false, false);

        $section->addText("2. Dokumentasi Acara");

        foreach ($documentations as $item) {
            $imagePath = public_path('storage/' . $item->filename);
            if (file_exists($imagePath)) {
                $section->addImage($imagePath, [
                    'alignment' => Alignment::HORIZONTAL_CENTER,
                    'width' => 420,
                    'height' => 250,
                ]);
            }
        }

        $section->addText("3. Daftar Hadir Peserta");
        foreach ($attendances as $item) {
            $imagePath = public_path('storage/' . $item->filename);
            if (file_exists($imagePath)) {
                $section->addImage($imagePath, [
                    'alignment' => Alignment::HORIZONTAL_CENTER,
                    'width' => 420,
                    'height' => 250,
                ]);
            }
        }

        $section->addText("4. Bukti Kwitansi");
        foreach ($receipts as $item) {
            $imagePath = public_path('storage/' . $item->filename);
            if (file_exists($imagePath)) {
                $section->addImage($imagePath, [
                    'alignment' => Alignment::HORIZONTAL_CENTER,
                    'width' => 420,
                    'height' => 250,
                ]);
            }
        }

        return $phpWord;
    }
}
