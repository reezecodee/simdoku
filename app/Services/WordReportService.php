<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\Table;

class WordReportService
{
    public static function print()
    {
        $phpWord = self::init();

        $phpWord = self::cover($phpWord);
        $phpWord = self::foreword($phpWord);
        $phpWord = self::TOC($phpWord);
        $phpWord = self::introduction($phpWord);
        $phpWord = self::implementationActivity($phpWord);
        $phpWord = self::closing($phpWord);
        $phpWord = self::attachments($phpWord);

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

    private static function cover($phpWord)
    {
        $section = $phpWord->addSection();
        $section->addText('LAPORAN', ['bold' => true, 'size' => 20], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        $section->addText("SHARING ILMU BARENG TDKF", ['bold' => true, 'size' => 20], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        $section->addText("“Langkah Mudah Menjadi Content Creator Tanpa Ribet”", ['bold' => true, 'size' => 12], ['alignment' => Alignment::HORIZONTAL_CENTER]);

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

    private static function foreword($phpWord)
    {
        $section = $phpWord->addSection();
        $section->addTitle('KATA PENGANTAR', 1);
        Html::addHtml($section, "<p>Dengan mengucap Puji Syukur Kehadirat Allah Yang Maha Kuasa yang telah melimpahkan Rahmat dan Hidayah-Nya kepada kami semua, sehingga kami dapat menyelesaikan Laporan pengajuan acara Sharing Ilmu Bareng TDKF dengan tema “Langkah Mudah Menjadi Content Creator Tanpa Ribet”.</p>", false, false);

        return $phpWord;
    }

    private static function TOC($phpWord)
    {
        $section = $phpWord->addSection();
        $section->addTitle('DAFTAR ISI', 1);

        return $phpWord;
    }

    private static function introduction($phpWord)
    {
        $section = $phpWord->addSection();
        $section->addTitle("BAB I", 1);
        $section->addTitle("PENDAHULUAN", 1);
        $section->addTitle('1.1 Latar Belakang', 2);
        Html::addHtml($section, "<p>Setelah terbentuknya TDKF (Tasik Digital Kreatif Forum) di Universitas BSI Kampus Tasikmalaya, sebagai langkah awal untuk launching dan mengenalkan TDKF pada masyarakat di Kota Tasikmalaya, maka tepatnya kiranya jika membuat sebuat event yang berkaitan erat dengan nama TDKF, yaitu tentang dunia Digital Kreatif. Saat ini, yang menjadi hobi dan ambisi sebagian besar masyarakat terutama anak muda dibidang digital kreatif adalah menjadi seorang content creator.</p>", false, false);

        $section->addTitle('1.2 Tujuan Kegiatan', 2);
        Html::addHtml($section, "<p>Nama kegiatan “Sharing Ilmu Bareng TDKF” dipilih dengan alasan agar event yang diselenggarakan ini terkesan lebih santai, belajar secara bersama, berkolaborasi, dan tidak terkesan “menggurui”. Sehingga diharapkan masyarakat dari berbagai kalangan dan usia akan lebih tertarik untuk ikut pada kegiatan ini. Ditambah dengan mendatangkan narasumber seorang content creator yang ternama, senior, memiliki banyak massa/follower, dan cukup terkenal di Kota Tasikmalaya, tentunya akan semakin menambah daya tarik dan nilai jual dari event ini.</p>", false, false);

        $section->addTitle('1.3 Manfaat Kegiatan', 2);
        Html::addHtml($section, "<p>Manfaat kegiatan ini adalah sebagai sarana dan media untuk menambah wawasan siswa dan masyarakat Tasikmalaya tentang pentingnya pemanfaatan teknologi dalam perkembangan dunia digital kreatif, dan lebih percaya diri untuk memulai berkreasi menjadi seorang content creator tanpa ribet, serta tentunya sebagai media branding promosi UBSI Kampus Tasikmalaya, dan menjalin relasi dan berkolaborasi dengan komunitas-komunitas di Kota Tasikmalaya dan sekitarnya, serta lebih jauhnya bisa mencapai ke Priangan Timur.</p>", false, false);

        $section->addTitle('1.4 Indikator Keberhasilan', 2);
        Html::addHtml($section, "<p>Manfaat kegiatan ini adalah sebagai sarana dan media untuk menambah wawasan siswa dan masyarakat Tasikmalaya tentang pentingnya pemanfaatan teknologi dalam perkembangan dunia digital kreatif, dan lebih percaya diri untuk memulai berkreasi menjadi seorang content creator tanpa ribet, serta tentunya sebagai media branding promosi UBSI Kampus Tasikmalaya, dan menjalin relasi dan berkolaborasi dengan komunitas-komunitas di Kota Tasikmalaya dan sekitarnya, serta lebih jauhnya bisa mencapai ke Priangan Timur.</p>", false, false);

        return $phpWord;
    }

    private static function implementationActivity($phpWord)
    {
        $section = $phpWord->addSection();
        $section->addTitle("BAB II", 1);
        $section->addTitle("PERENCANAAN KEGIATAN", 1);

        $section->addTitle('2.1 Nama dan Tema Kegiatan', 2);
        Html::addHtml($section, '<p>Nama kegiatan ini adalah Sharing Ilmu Bareng TDKF dengan tema "Langkah Mudah Menjadi Content Creator Tanpa Ribet"</p>', false, false);

        $section->addTitle('2.2 Deskripsi Kegiatan', 2);
        Html::addHtml($section, "<p>Manfaat kegiatan ini adalah sebagai sarana dan media untuk menambah wawasan siswa dan masyarakat Tasikmalaya tentang pentingnya pemanfaatan teknologi dalam perkembangan dunia digital kreatif, dan lebih percaya diri untuk memulai berkreasi menjadi seorang content creator tanpa ribet, serta tentunya sebagai media branding promosi UBSI Kampus Tasikmalaya, dan menjalin relasi dan berkolaborasi dengan komunitas-komunitas di Kota Tasikmalaya dan sekitarnya, serta lebih jauhnya bisa mencapai ke Priangan Timur.</p>", false, false);

        $section->addTitle('2.3 Penyelenggara Kegiatan', 2);
        Html::addHtml($section, "<p>Kegiatan ini diselenggarakan oleh Universitas Bina Sarana Informatika Kampus Tasikmalaya dan TDKF (Tasik Digital Kreatif Forum).</p>", false, false);

        $section->addTitle('2.4 Pemateri atau Narasumber', 2);
        Html::addHtml($section, "<p>Kegiatan ini diselenggarakan oleh Universitas Bina Sarana Informatika Kampus Tasikmalaya dan TDKF (Tasik Digital Kreatif Forum). asdkjasd aksdha dq 42342 ahqwdasd kqh 3424 asdada @asd 434%$^ </p>", false, false);

        $section->addTitle('2.5 Peserta Kegiatan', 2);
        Html::addHtml($section, "<p>Kegiatan ini diselenggarakan oleh Universitas Bina Sarana Informatika Kampus Tasikmalaya dan TDKF (Tasik Digital Kreatif Forum). asdkjasd aksdha dq 42342 ahqwdasd kqh 3424 asdada @asd 434%$^ </p>", false, false);

        $section->addTitle('2.6 Waktu Pelaksanaan', 2);
        Html::addHtml($section, "<p>Kegiatan ini diselenggarakan oleh Universitas Bina Sarana Informatika Kampus Tasikmalaya dan TDKF (Tasik Digital Kreatif Forum). asdkjasd aksdha dq 42342 ahqwdasd kqh 3424 asdada @asd 434%$^ </p>", false, false);

        $section->addTitle('2.7 Evaluasi Kegiatan', 2);
        $section->addText("a. Jumlah Peserta", ['bold' => true]);
        $section->addText("- Jumlah peserta daftar : 188 Orang");
        $section->addText("- Jumlah peserta hadir : 103 Orang peserta");

        $imagePath = public_path('charts/pie.png');
        $section->addImage($imagePath, [
            'alignment' => Jc::CENTER,
            'width' => 420,
            'height' => 250,
        ]);

        $section->addText("b. Kepuasan Peserta", ['bold' => true]);
        $section->addImage($imagePath, [
            'alignment' => Jc::CENTER,
            'width' => 420,
            'height' => 250,
        ]);

        $section->addText("c. Penilaian Tentang Acara", ['bold' => true]);
        $section->addImage($imagePath, [
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

        $section->addTitle('2.8 Susunan Acara', 2);
        $table = $section->addTable('CustomTable');

        $table->addRow();
        $table->addCell(1000, $headerStyle)->addText("NO", ['bold' => true], 'TableHeaderStyle');
        $table->addCell(2000, $headerStyle)->addText("WAKTU", ['bold' => true], 'TableCellStyle');
        $table->addCell(4000, $headerStyle)->addText("Sub Acara", ['bold' => true], 'TableCellStyle');
        $table->addCell(5000, $headerStyle)->addText("KETERANGAN", ['bold' => true], 'TableCellStyle');

        $table->addRow();
        $table->addCell(1000)->addText("1", [], 'TableHeaderStyle');
        $table->addCell(2000)->addText("08.00 - 09.00", [], 'TableCellStyle');
        $table->addCell(4000)->addText("Video - video opening event", [], 'TableCellStyle');
        $table->addCell(5000)->addText("Sie Regis + Multimedia + Sie Pengatur Peserta + Sie Konsumsi", [], 'TableCellStyle');

        $table->addRow();
        $table->addCell(1000)->addText("2", [], 'TableHeaderStyle');
        $table->addCell(2000)->addText("08.00 - 09.00", [], 'TableCellStyle');
        $table->addCell(4000)->addText("Video - video opening event", [], 'TableCellStyle');
        $table->addCell(5000)->addText("Sie Regis + Multimedia + Sie Pengatur Peserta + Sie Konsumsi", [], 'TableCellStyle');


        $section->addTextBreak(1);

        $section->addTitle('2.9 Susunan Panitia', 2);
        $table = $section->addTable('CustomTable');

        $table->addRow();
        $table->addCell(1000, $headerStyle)->addText("NO", ['bold' => true], 'TableHeaderStyle');
        $table->addCell(4000, $headerStyle)->addText("Nama Panitia", ['bold' => true], 'TableCellStyle');
        $table->addCell(4000, $headerStyle)->addText("Peran Panitia", ['bold' => true], 'TableCellStyle');

        $table->addRow();
        $table->addCell(1000)->addText("1", [], 'TableHeaderStyle');
        $table->addCell(4000)->addText("Budi Santoso", [], 'TableCellStyle');
        $table->addCell(4000)->addText("Ketua Pelaksana", [], 'TableCellStyle');

        $table->addRow();
        $table->addCell(1000)->addText("2", [], 'TableHeaderStyle');
        $table->addCell(4000)->addText("Rina Kartika", [], 'TableCellStyle');
        $table->addCell(4000)->addText("Sekretaris", [], 'TableCellStyle');

        $section->addTextBreak(1);

        $section->addTitle('2.9 Susunan Panitia', 2);
        $table = $section->addTable('CustomTable');

        $table->addRow();
        $table->addCell(6000, $headerStyle)->addText("Anggaran", ['bold' => true], 'TableHeaderStyle');
        $table->addCell(2000, $headerStyle)->addText("Jumlah", ['bold' => true], 'TableHeaderStyle');
        $table->addCell(3000, $headerStyle)->addText("(Rupiah)", ['bold' => true], 'TableHeaderStyle');

        $table->addRow();
        $table->addCell(6000)->addText("Spanduk (4x1)", [], 'TableCellStyle');
        $table->addCell(2000)->addText("1", [], 'TableHeaderStyle');
        $table->addCell(3000)->addText("Rp. 150000", [], 'TableCellStyle');

        $table->addRow();
        $table->addCell(6000)->addText("Baliho (3x2)", [], 'TableCellStyle');
        $table->addCell(2000)->addText("1", [], 'TableHeaderStyle');
        $table->addCell(3000)->addText("Rp. 50000", [], 'TableCellStyle');

        $table->addRow();
        $table->addCell(8000, ['gridSpan' => 2])->addText("Total pengeluaran", ['bold' => true, 'italic' => true, 'alignment' => 'center'], 'TableHeaderStyle');
        $table->addCell(3000)->addText("Rp. 200000", ['bold' => true], 'TableHeaderStyle');

        $section->addTextBreak(1);

        return $phpWord;
    }

    private static function closing($phpWord)
    {
        $section = $phpWord->addSection();
        $section->addTitle("BAB III", 1);
        $section->addTitle("PENUTUP", 1);
        Html::addHtml($section, "<p>Demikianlah laporan Sharing Ilmu Bareng TDKF dengan tema \"Langkah Mudah Menjadi Content Creator Tanpa Ribet\" kami sampaikan. Besar harapan kami demi kelancaran kegiatan ini partisipasi dari semua pihak sangat kami harapkan demi keberhasilan kegiatan ini. Atas perhatian bapak/ibu serta semua pihak yang ada, kami ucapkan banyak terima kasih</p>", false, false);
        $section->addText("Tasikmalaya, 28 Agustus 2024", [], ['alignment' => Jc::CENTER]);
        $section->addTextBreak(2);
        $section->addText("Hormat Kami,", [], ['alignment' => Jc::CENTER]);

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
            ['alignment' => Jc::CENTER]
        );
        $cell2->addText(
            "Pelaksana,",
            [],
            ['alignment' => Jc::CENTER]
        );

        $table->addRow();
        $cell1 = $table->addCell(4000);
        $cell2 = $table->addCell(4000);

        $cell1->addImage(public_path('ttd.png'), [
            'width' => 110,
            'height' => 50,
            'alignment' => Jc::CENTER
        ]);
        $cell2->addImage(public_path('ttd.png'), [
            'width' => 110,
            'height' => 50,
            'alignment' => Jc::CENTER
        ]);

        $table->addRow();
        $cell1 = $table->addCell(5000);
        $cell2 = $table->addCell(5000);

        $cell1->addText(
            "Budi Nugraha",
            ['underline' => 'single'],
            ['alignment' => Jc::CENTER]
        );
        $cell2->addText(
            "Budi Al Harits",
            ['underline' => 'single'],
            ['alignment' => Jc::CENTER]
        );

        $table->addRow();
        $cell1 = $table->addCell(5000);
        $cell2 = $table->addCell(5000);

        $cell1->addText(
            "Ketua Pelaksana",
            ['bold' => true],
            ['alignment' => Jc::CENTER]
        );
        $cell2->addText(
            "Kepala Kampus UBSI Tasikmalaya",
            ['bold' => true],
            ['alignment' => Jc::CENTER]
        );

        $section->addTextBreak(1);

        $table = $section->addTable($tableStyle);

        $table->addRow();
        $cell1 = $table->addCell(5000);

        $cell1->addText(
            "Menyetujui,",
            [],
            ['alignment' => Jc::CENTER]
        );

        $table->addRow();
        $cell1 = $table->addCell(4000);

        $cell1->addText("", [], ['align' => 'center']);

        $table->addRow();
        $cell1 = $table->addCell(5000);

        $cell1->addText(
            "Elfira Karina",
            ['underline' => 'single'],
            ['alignment' => Jc::CENTER]
        );

        $table->addRow();
        $cell1 = $table->addCell(10000);

        $cell1->addText(
            "Kadiv DMER Universitas Bina Sarana Informatika",
            ['bold' => true],
            ['alignment' => Jc::CENTER]
        );

        return $phpWord;
    }

    private static function attachments($phpWord)
    {
        $section = $phpWord->addSection();

        $section->addTitle('Lampiran-lampiran', 2);
        $section->addText("1. Press Release");
        Html::addHtml($section, "<ul><li>asdasdasdasd asdad asdasd asdas as</li><li>asdasdasdasd asdad asdasd asdas as</li><li>asdasdasdasd asdad asdasd asdas as</li><li>asdasdasdasd asdad asdasd asdas as</li></ul>", false, false);

        $section->addText("2. Dokumentasi Acara");
        $imagePath = public_path('charts/dokumentasi.jpg');
        if (file_exists($imagePath)) {
            $section->addImage($imagePath, [
                'alignment' => Alignment::HORIZONTAL_CENTER,
                'width' => 420,
                'height' => 250,
            ]);
        }
        if (file_exists($imagePath)) {
            $section->addImage($imagePath, [
                'alignment' => Alignment::HORIZONTAL_CENTER,
                'width' => 420,
                'height' => 250,
            ]);
        }
        if (file_exists($imagePath)) {
            $section->addImage($imagePath, [
                'alignment' => Alignment::HORIZONTAL_CENTER,
                'width' => 420,
                'height' => 250,
            ]);
        }

        $section->addText("3. Daftar Hadir Peserta");
        if (file_exists($imagePath)) {
            $section->addImage($imagePath, [
                'alignment' => Alignment::HORIZONTAL_CENTER,
                'width' => 420,
                'height' => 250,
            ]);
        }
        if (file_exists($imagePath)) {
            $section->addImage($imagePath, [
                'alignment' => Alignment::HORIZONTAL_CENTER,
                'width' => 420,
                'height' => 250,
            ]);
        }

        $section->addText("4. Bukti Kwitansi");
        if (file_exists($imagePath)) {
            $section->addImage($imagePath, [
                'alignment' => Alignment::HORIZONTAL_CENTER,
                'width' => 420,
                'height' => 250,
            ]);
        }

        return $phpWord;
    }
}
