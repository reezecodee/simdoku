<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\Table;

class WordProposalService
{
    public static function print($proposal, $my, $today, $planSchedules, $committees, $budgets)
    {
        $phpWord = self::init();

        $phpWord = self::cover($phpWord, $proposal);
        $phpWord = self::foreword($phpWord, $proposal, $my, $today);
        $phpWord = self::TOC($phpWord);
        $phpWord = self::introduction($phpWord, $proposal);
        $phpWord = self::planActivity($phpWord, $proposal, $planSchedules, $committees, $budgets);
        $phpWord = self::closing($phpWord, $proposal, $today, $my);

        return self::output($phpWord, $proposal);
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

    private static function output($phpWord, $proposal)
    {
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $title = " " . $proposal->judul ?? "Tak Berjudul";

        $fileName = "Dokumen Proposal:{$title}.docx";
        return response()->stream(
            function () use ($objWriter) {
                $objWriter->save('php://output');
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

    private static function cover($phpWord, $proposal)
    {
        $section = $phpWord->addSection();
        $section->addText('PROPOSAL', ['bold' => true, 'size' => 16], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        $section->addText($proposal->judul, ['bold' => true, 'italic' => true, 'size' => 20], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        $section->addText($proposal->tahun, ['bold' => true, 'size' => 16], ['alignment' => Alignment::HORIZONTAL_CENTER]);

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

        $section->addText('UNIVERSITAS BINA SARANA INFORMATIKA KAMPUS KOTA', ['bold' => true, 'size' => 14], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        $section->addText('TASIKMALAYA', ['bold' => true, 'size' => 14], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        $section->addText(date('Y'), ['bold' => true, 'size' => 14], ['alignment' => Alignment::HORIZONTAL_CENTER]);

        return $phpWord;
    }

    private static function foreword($phpWord, $proposal, $my, $today)
    {
        $section = $phpWord->addSection();
        $section->addTitle('KATA PENGANTAR', 1);
        Html::addHtml($section, paragraph($proposal->kata_pengantar), false, false);

        $section->addTextBreak(2);

        $section->addText('Tasikmalaya, ' . $today, [
            'indentation' => ['firstLine' => 0]
        ], [
            'alignment' => Alignment::HORIZONTAL_RIGHT
        ]);
        $section->addText('Penyusun', [], [
            'indentation' => [
                'left' => 0
            ],
            'alignment' => Alignment::HORIZONTAL_RIGHT
        ]);
        $section->addTextBreak(2);
        $section->addText($my->nama, [], [
            'indentation' => [
                'left' => 0,
            ],
            'alignment' => Alignment::HORIZONTAL_RIGHT
        ]);

        return $phpWord;
    }

    private static function TOC($phpWord)
    {
        $section = $phpWord->addSection();
        $section->addTitle("DAFTAR ISI", 1);

        return $phpWord;
    }

    private static function introduction($phpWord, $proposal)
    {
        $proposal = $proposal->introduction;
        $section = $phpWord->addSection();
        $section->addTitle("BAB I", 1);
        $section->addTitle("PENDAHULUAN", 1);
        $section->addTitle('1.1 Latar Belakang', 2);
        Html::addHtml($section, paragraph($proposal->latar_belakang), false, false);

        $section->addTitle('1.2 Tujuan Kegiatan', 2);
        Html::addHtml($section, paragraph($proposal->tujuan_kegiatan), false, false);

        $section->addTitle('1.3 Indikator Keberhasilan', 2);
        Html::addHtml($section, paragraph($proposal->indikator_keberhasilan), false, false);

        return $phpWord;
    }

    private static function planActivity($phpWord, $proposal, $planSchedules, $committees, $budgets)
    {
        $proposal = $proposal->planActivity;
        $section = $phpWord->addSection();
        $section->addTitle("BAB II", 1);
        $section->addTitle("PERENCANAAN KEGIATAN", 1);
        $section->addTitle('2.1 Nama dan Tema Kegiatan', 2);
        Html::addHtml($section, paragraph($proposal->tema_kegiatan), false, false);

        $section->addTitle('2.2 Deskripsi Kegiatan', 2);
        Html::addHtml($section, paragraph($proposal->deskripsi_kegiatan), false, false);

        $section->addTitle('2.3 Penyelenggara Kegiatan', 2);
        Html::addHtml($section, paragraph($proposal->penyelenggara_kegiatan), false, false);

        $section->addTitle('2.4 Peserta Kegiatan', 2);
        Html::addHtml($section, paragraph($proposal->peserta_kegiatan), false, false);

        $section->addTitle('2.5 Waktu Pelaksanaan', 2);
        Html::addHtml($section, paragraph($proposal->waktu_pelaksanaan), false, false);

        $tableStyle = [
            'borderSize' => 6,
            'borderColor' => '000000',
            'alignment' => Jc::CENTER,
            'layout' => Table::LAYOUT_FIXED,
        ];

        $phpWord->addTableStyle('CustomTable', $tableStyle);

        $headerStyle = ['bgColor' => 'D9D9D9'];

        if ($planSchedules->isNotEmpty()) {
            $section->addTitle('2.6 Susunan Acara', 2);
            $table = $section->addTable('CustomTable');

            $table->addRow();
            $table->addCell(1500, $headerStyle)->addText("No");
            $table->addCell(6000, $headerStyle)->addText("Nama Kegiatan");
            $table->addCell(3500, $headerStyle)->addText("Waktu");

            $no = 1;
            foreach ($planSchedules as $item) {
                $table->addRow();
                $table->addCell(1500)->addText($no);
                $table->addCell(6000)->addText($item->nama_kegiatan);
                $table->addCell(3500)->addText($item->waktu);
                $no++;
            }
            $section->addTextBreak(1);
        }

        if ($committees->isNotEmpty()) {
            $section->addTitle('2.7 Susunan Panitia', 2);
            $table = $section->addTable('CustomTable');

            $table->addRow();
            $table->addCell(1500, $headerStyle)->addText("No");
            $table->addCell(6000, $headerStyle)->addText("Nama Panitia");
            $table->addCell(3500, $headerStyle)->addText("Peran");

            $no = 1;
            foreach ($committees as $item) {
                $table->addRow();
                $table->addCell(1500)->addText($no);
                $table->addCell(6000)->addText($item->nama);
                $table->addCell(3500)->addText($item->peran);
                $no++;
            }
            $section->addTextBreak(1);
        }

        if ($budgets->isNotEmpty()) {
            $section->addTitle('2.8 Rencana Anggaran', 2);
            $totalBudgets = $budgets->sum('total');
            $table = $section->addTable('CustomTable');

            $table->addRow();
            $table->addCell(6000, $headerStyle)->addText("Uraian");
            $table->addCell(3500, $headerStyle)->addText("Jumlah");
            $table->addCell(3500, $headerStyle)->addText("Total");

            foreach ($budgets as $item) {
                $table->addRow();
                $table->addCell(6000)->addText($item->uraian);
                $table->addCell(3500)->addText($item->jumlah);
                $table->addCell(3500)->addText($item->total);
            }

            $table->addRow();
            $table->addCell(7500, ['gridSpan' => 2])->addText("Jumlah pengeluaran");
            $table->addCell(3500)->addText("Rp. {$totalBudgets}");
            $section->addTextBreak(1);
        }

        return $phpWord;
    }

    private static function closing($phpWord, $proposal, $today, $my)
    {
        $section = $phpWord->addSection();
        $section->addTitle("BAB III", 1);
        $section->addTitle("PENUTUP", 1);
        Html::addHtml($section, paragraph($proposal->penutup), false, false);

        $section->addText("Tasikmalaya, {$today}", [], [
            'alignment' => Alignment::HORIZONTAL_RIGHT
        ]);
        $section->addText('Hormat Kami,', [], [
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);

        $tableStyle = [
            'alignment' => Jc::CENTER,
            'cellMargin' => 0,
        ];

        $table = $section->addTable($tableStyle);

        $table->addRow();
        $cell1 = $table->addCell(4000);
        $cell2 = $table->addCell(4000);

        $cell1->addImage(storage_path('app/public/' . $proposal->signature->tanda_tangan), [
            'width' => 110,
            'height' => 50,
            'alignment' => Jc::CENTER
        ]);
        $cell2->addImage(storage_path('app/public/' . $my->tanda_tangan), [
            'width' => 110,
            'height' => 50,
            'alignment' => Jc::CENTER
        ]);

        $table->addRow();
        $cell1 = $table->addCell(5000);
        $cell2 = $table->addCell(5000);

        $cell1->addText(
            $proposal->signature->nama_pemilik,
            ['bold' => true],
            ['alignment' => Jc::CENTER]
        );
        $cell2->addText(
            $my->nama,
            ['bold' => true],
            ['alignment' => Jc::CENTER]
        );

        $table->addRow();
        $cell1 = $table->addCell(5000);
        $cell2 = $table->addCell(5000);

        $cell1->addText(
            "Ketua Panitia",
            [],
            ['alignment' => Jc::CENTER]
        );
        $cell2->addText(
            "Kepala Kampus",
            [],
            ['alignment' => Jc::CENTER]
        );

        return $phpWord;
    }
}
