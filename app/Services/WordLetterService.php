<?php

namespace App\Services;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\IOFactory;

class WordLetterService
{
    protected static $styleTable = [
        'borderSize' => 6,
        'borderColor' => '000000',
        'cellMargin' => 70
    ];

    public static function print($today, $letter, $executionStaffs, $executionVolunteers, $my)
    {
        $result = self::init();
        $section = $result[0];
        $phpWord = $result[1];

        $section = self::addHeader($section, $today, $letter);
        $section = self::addStaffTable($section, $executionStaffs);
        $section = self::addVolunteerTable($section, $executionVolunteers);
        $section = self::addSignature($section, $letter, $my);

        $output = self::output($phpWord);

        return $output;
    }

    private static function init()
    {
        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(11);
        $phpWord->setDefaultParagraphStyle([
            'lineHeight' => 1,
        ]);

        $section = $phpWord->addSection([
            'paperSize' => 'Letter'
        ]);

        return [
            $section,
            $phpWord
        ];
    }

    private static function output($phpWord)
    {
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

        $fileName = 'surat_pengajuan.docx';
        $response = response()->stream(
            function () use ($objWriter) {
                $objWriter->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'Content-Disposition' => 'attachment;filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
                'Cache-Control' => 'max-age=1',
            ]
        );

        return $response;
    }

    private static function addHeader($section, $today, $letter)
    {
        $section->addText("Tasikmalaya, {$today}", [], ['alignment' => Alignment::HORIZONTAL_RIGHT]);
        $section->addText('Kepada Yth.', [], ['alignment' => Alignment::HORIZONTAL_LEFT]);
        $section->addText('Kepada Divisi MER Universitas Bina Sarana Informatika.', [], ['alignment' => Alignment::HORIZONTAL_LEFT]);
        $section->addText($letter->kepala_devisi_mer, [], ['alignment' => Alignment::HORIZONTAL_LEFT]);
        $section->addText('di', [], ['alignment' => Alignment::HORIZONTAL_LEFT]);
        $textRun = $section->addTextRun(['alignment' => Alignment::HORIZONTAL_LEFT]);
        $textRun->addText("\t");
        $textRun->addText("JAKARTA", ['spacing' => 150, 'underline' => 'single']);
        $section->addText("Perihal: {$letter->perihal}", [], ['alignment' => Alignment::HORIZONTAL_LEFT]);
        $section->addText("Berikut kami kirimkan pengajuan Surat Tugas kegiatan {$letter->nama_acara}. Berikut Staf yang akan bertugas:", [], ['alignment' => Alignment::HORIZONTAL_LEFT]);

        return $section;
    }

    private static function tableRow($section, $col)
    {
        $table = $section->addTable(self::$styleTable);

        $table->addRow();
        $table->addCell(800, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("No", [], ['alignment' => Jc::CENTER]);
        $table->addCell(1500, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText($col, [], ['alignment' => Jc::CENTER]);
        $table->addCell(4000, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("Nama", [], ['alignment' => Jc::CENTER]);
        $table->addCell(2500, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("Sekolah", [], ['alignment' => Jc::CENTER]);
        $table->addCell(2500, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("Tanggal Pelaksanaan", [], ['alignment' => Jc::CENTER]);

        return $table;
    }

    private static function addStaffTable($section, $executionStaffs)
    {
        if ($executionStaffs->isNotEmpty()) {
            $table = self::tableRow($section, 'NIP');

            foreach ($executionStaffs as $index => $execution) {
                $relatedStaffs = $execution->staff;

                $table->addRow();
                $table->addCell(800, ['vMerge' => 'restart', 'valign' => 'center'])
                    ->addText($index + 1, [], ['alignment' => Jc::CENTER]);

                if ($relatedStaffs->count() == 0) {
                    $table->addCell(5500, ['gridSpan' => 2])->addText("Belum ada anggota", [], []);
                } else {
                    $table->addCell(1500)->addText($relatedStaffs->first()->nip, [], ['alignment' => Jc::CENTER]);
                    $table->addCell(4000)->addText($relatedStaffs->first()->nama, [], []);
                }

                $table->addCell(2500, ['vMerge' => 'restart', 'valign' => 'center'])
                    ->addText($execution->nama_sekolah, ['bold' => true], ['alignment' => Jc::CENTER]);

                $table->addCell(2500, ['vMerge' => 'restart', 'valign' => 'center'])
                    ->addText($execution->tgl_pelaksanaan, [], ['alignment' => Jc::CENTER]);

                if ($relatedStaffs->count() > 1) {
                    foreach ($relatedStaffs->skip(1) as $staff) {
                        $table->addRow();
                        $table->addCell(null, ['vMerge' => 'continue']);
                        $table->addCell(1500)->addText($staff->nip, [], ['alignment' => Jc::CENTER]);
                        $table->addCell(4000)->addText($staff->nama, [], []);
                        $table->addCell(2500, ['vMerge' => 'continue']);
                        $table->addCell(2500, ['vMerge' => 'continue']);
                    }
                }
            }
            $section->addTextBreak(1);

            return $section;
        }
    }

    private static function addVolunteerTable($section, $executionVolunteers)
    {
        if ($executionVolunteers->isNotEmpty()) {
            $section->addText('Volunteer:', ['bold' => true], ['alignment' => Alignment::HORIZONTAL_LEFT]);

            $table = self::tableRow($section, 'NIM');

            foreach ($executionVolunteers as $index => $execution) {
                $relatedVolunteers = $execution->volunteer;

                $table->addRow();
                $table->addCell(800, ['vMerge' => 'restart', 'valign' => 'center'])
                    ->addText($index + 1, [], ['alignment' => Jc::CENTER]);

                if ($relatedVolunteers->count() == 0) {
                    $table->addCell(5500, ['gridSpan' => 2])->addText("Belum ada anggota", [], []);
                } else {
                    $table->addCell(1500)->addText($relatedVolunteers->first()->nim, [], ['alignment' => Jc::CENTER]);
                    $table->addCell(4000)->addText($relatedVolunteers->first()->nama, [], []);
                }

                $table->addCell(2500, ['vMerge' => 'restart', 'valign' => 'center'])
                    ->addText($execution->nama_sekolah, ['bold' => true], ['alignment' => Jc::CENTER]);

                $table->addCell(2500, ['vMerge' => 'restart', 'valign' => 'center'])
                    ->addText($execution->tgl_pelaksanaan, [], ['alignment' => Jc::CENTER]);

                if ($relatedVolunteers->count() > 1) {
                    foreach ($relatedVolunteers->skip(1) as $volunteer) {
                        $table->addRow();
                        $table->addCell(null, ['vMerge' => 'continue']);
                        $table->addCell(1500)->addText($volunteer->nim, [], ['alignment' => Jc::CENTER]);
                        $table->addCell(4000)->addText($volunteer->nama, [], []);
                        $table->addCell(2500, ['vMerge' => 'continue']);
                        $table->addCell(2500, ['vMerge' => 'continue']);
                    }
                }
            }
            $section->addTextBreak(1);

            return $section;
        }
    }

    private static function addSignature($section, $letter, $my)
    {
        $section->addText("\tDemikian pengajuan ini kami sampaikan. Atas segala perhatian dan kebijakannya kami mengucapkan terimakasih.", [], ['alignment' => Alignment::HORIZONTAL_LEFT]);

        $section->addTextBreak(1);

        $tableStyle = [
            'alignment' => Jc::CENTER,
            'cellMargin' => 0,
        ];

        $table = $section->addTable($tableStyle);

        $table->addRow();
        $cell1 = $table->addCell(5000);
        $cell2 = $table->addCell(5000);

        $cell1->addText(
            "Koordinator Markom UBSI Tasikmalaya",
            [],
            ['alignment' => Jc::CENTER]
        );
        $cell2->addText(
            "Kepala Kampus UBSI Tasikmalaya",
            [],
            ['alignment' => Jc::CENTER]
        );

        $table->addRow();
        $cell1 = $table->addCell(4000);
        $cell2 = $table->addCell(4000);

        $cell1->addImage(storage_path('app/public/' . $letter->signature->tanda_tangan), [
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
            $letter->signature->nama_pemilik,
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
            "NIP. {$letter->signature->nip}",
            [],
            ['alignment' => Jc::CENTER]
        );
        $cell2->addText(
            "NIP. {$my->nip}",
            [],
            ['alignment' => Jc::CENTER]
        );

        return $section;
    }
}
