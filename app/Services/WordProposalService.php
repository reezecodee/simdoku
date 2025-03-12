<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\Cell;
use PhpOffice\PhpWord\Style\Table;

class WordProposalService
{
    public static function print($proposal, $my, $today, $planSchedules, $committees)
    {
        $phpWord = self::init();

        $phpWord = self::cover($phpWord, $proposal);
        $phpWord = self::foreword($phpWord, $proposal, $my, $today);
        $phpWord = self::TOC($phpWord);
        $phpWord = self::introduction($phpWord, $proposal);
        $phpWord = self::planActivity($phpWord, $proposal, $planSchedules, $committees);
        $phpWord = self::closing($phpWord, $proposal, $today, $my);

        return self::output($phpWord);
    }

    private static function init()
    {
        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);
        $phpWord->setDefaultParagraphStyle([
            'indentation' => ['firstLine' => 480],
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,
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

        $fileName = 'surat_tugas.docx';
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

        $section->addText('UNIVERSITAS BINA SARANA INFORMATIKA KAMPUS KOTA ', ['bold' => true, 'size' => 14], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        $section->addText('TASIKMALAYA', ['bold' => true, 'size' => 14], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        $section->addText(date('Y'), ['bold' => true, 'size' => 14], ['alignment' => Alignment::HORIZONTAL_CENTER]);

        return $phpWord;
    }

    private static function foreword($phpWord, $proposal, $my, $today)
    {
        $section = $phpWord->addSection();
        $section->addTitle('KATA PENGANTAR', 1);
        Html::addHtml($section, self::convertToParagraph($proposal->kata_pengantar), false, false);

        $section->addTextBreak(2);

        $section->addText('Tasikmalaya, ' . $today, [
            'indentation' => ['firstLine' => 0]
        ], [
            'alignment' => Alignment::HORIZONTAL_RIGHT
        ]);
        $section->addText('Penyusun', [], [
            'indentation' => [
                'left' => 0,
                'right' => 820
            ],
            'alignment' => Alignment::HORIZONTAL_RIGHT
        ]);
        $section->addTextBreak(1);
        $section->addText($my->nama, [], [
            'indentation' => [
                'left' => 0,
            ],
            'alignment' => Alignment::HORIZONTAL_RIGHT
        ]);

        $footer = $section->addFooter();
        $footer->addPreserveText('{PAGE}', null, [
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
        ]);

        return $phpWord;
    }

    private static function TOC($phpWord)
    {
        $section = $phpWord->addSection();
        $section->addTitle("DAFTAR ISI", 1);

        $footer = $section->addFooter();
        $footer->addPreserveText('{PAGE}', null, [
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
        ]);

        return $phpWord;
    }

    private static function introduction($phpWord, $proposal)
    {
        $proposal = $proposal->introduction;
        $section = $phpWord->addSection();
        $section->addTitle("BAB I", 1);
        $section->addTitle("PENDAHULUAN", 1);
        $section->addTitle('1.1 Latar Belakang', 2);
        Html::addHtml($section, self::convertToParagraph($proposal->latar_belakang), false, false);

        $section->addTitle('1.2 Tujuan Kegiatan', 2);
        Html::addHtml($section, self::convertToParagraph($proposal->tujuan_kegiatan), false, false);

        $section->addTitle('1.3 Indikator Keberhasilan', 2);
        Html::addHtml($section, self::convertToParagraph($proposal->indikator_keberhasilan), false, false);

        $footer = $section->addFooter();
        $footer->addPreserveText('{PAGE}', null, [
            'alignment' => Jc::CENTER
        ]);

        return $phpWord;
    }

    private static function planActivity($phpWord, $proposal, $planSchedules, $committees)
    {
        $proposal = $proposal->planActivity;
        $section = $phpWord->addSection();
        $section->addTitle("BAB II", 1);
        $section->addTitle("PERENCANAAN KEGIATAN", 1);
        $section->addTitle('2.1 Nama dan Tema Kegiatan', 2);
        Html::addHtml($section, self::convertToParagraph($proposal->tema_kegiatan), false, false);

        $section->addTitle('2.2 Deskripsi Kegiatan', 2);
        Html::addHtml($section, self::convertToParagraph($proposal->deskripsi_kegiatan), false, false);

        $section->addTitle('2.3 Penyelenggara Kegiatan', 2);
        Html::addHtml($section, self::convertToParagraph($proposal->penyelenggara_kegiatan), false, false);

        $section->addTitle('2.4 Peserta Kegiatan', 2);
        Html::addHtml($section, self::convertToParagraph($proposal->peserta_kegiatan), false, false);

        $section->addTitle('2.5 Waktu Pelaksanaan', 2);
        Html::addHtml($section, self::convertToParagraph($proposal->waktu_pelaksanaan), false, false);

        $section->addTitle('2.6 Susunan Acara', 2);
        $tableStyle = [
            'borderSize' => 6,
            'borderColor' => '000000',
            'alignment' => Jc::CENTER,
            'layout' => Table::LAYOUT_FIXED,
        ];

        $phpWord->addTableStyle('CustomTable', $tableStyle);
        $table = $section->addTable('CustomTable');

        $headerStyle = ['bgColor' => 'D9D9D9'];

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

        $section->addTitle('2.7 Susunan Panitia', 2);
        $table = $section->addTable('CustomTable');

        $headerStyle = ['bgColor' => 'D9D9D9'];

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

        $section->addTitle('2.8 Rencana Anggaran', 2);
        Html::addHtml($section, "<p>Total anggaran yang dibutuhkan adalah <strong>Rp 10.000.000,-</strong></p>", false, false);

        $footer = $section->addFooter();
        $footer->addPreserveText('{PAGE}', null, [
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
        ]);

        return $phpWord;
    }

    private static function closing($phpWord, $proposal, $today, $my)
    {
        $section = $phpWord->addSection();
        $section->addTitle("BAB III", 1);
        $section->addTitle("PENUTUP", 1);
        Html::addHtml($section, self::convertToParagraph($proposal->penutup), false, false);

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
            ['bold' => true],
            ['alignment' => Jc::CENTER]
        );
        $cell2->addText(
            "Kepala Kampus",
            ['bold' => true],
            ['alignment' => Jc::CENTER]
        );

        $footer = $section->addFooter();
        $footer->addPreserveText('{PAGE}', null, [
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
        ]);

        return $phpWord;
    }

    private static function convertToParagraph($content)
    {
        $content = preg_replace('/<div>(.*?)<\/div>/', '<p>$1</p>', $content);
        $content = preg_replace('/<br\s*\/?>/', "\n", $content);
        $content = preg_replace('/\n+/', '</p><p>', $content);
        $content = preg_replace('/<p>\s*<\/p>/', '', $content);

        return $content;
    }
}
