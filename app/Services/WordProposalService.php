<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;

class WordProposalService
{
    public static function print()
    {
        $phpWord = self::init();

        $phpWord = self::cover($phpWord);
        $phpWord = self::foreword($phpWord);
        $phpWord = self::introduction($phpWord);
        $phpWord = self::planActivity($phpWord);
        $phpWord = self::closing($phpWord);

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

    private static function cover($phpWord)
    {
        $section = $phpWord->addSection();
        $section->addText('PROPOSAL', ['bold' => true, 'size' => 16], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        $section->addText('BSI FLASH JAPANASE FESTIVAL', ['bold' => true, 'italic' => true, 'size' => 20], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        $section->addText(date('Y'), ['bold' => true, 'size' => 16], ['alignment' => Alignment::HORIZONTAL_CENTER]);

        $section->addTextBreak(3);
        $imagePath = public_path('images/logo/logo-bsi.png');
        if (file_exists($imagePath)) {
            $section->addImage($imagePath, [
                'alignment' => Alignment::VERTICAL_CENTER,
                'width' => 150,
                'height' => 150,
            ]);
        }
        $section->addTextBreak(5);

        $section->addText('UNIVERSITAS BINA SARANA INFORMATIKA KAMPUS KOTA ', ['bold' => true, 'size' => 14], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        $section->addText('TASIKMALAYA', ['bold' => true, 'size' => 14], ['alignment' => Alignment::HORIZONTAL_CENTER]);
        $section->addText(date('Y'), ['bold' => true, 'size' => 14], ['alignment' => Alignment::HORIZONTAL_CENTER]);

        return $phpWord;
    }

    private static function foreword($phpWord)
    {
        $section = $phpWord->addSection();
        $section->addTitle('KATA PENGANTAR', 1);
        Html::addHtml($section, 'Alhamdulillahi rabbil„alamin, dengan segala kerendahan hati, kami panjatkan puji dan syukur kehadirat Allah SWT, karena atas izin, rahmat serta hidayah Nya, proposal acara kegiatan Festival Budaya Jepang di Universitas Bina Sarana Informatika dengan tema “BSI FLASH JAPANASE FESTIVAL” telah selesai disusun.', false, false);

        $section->addTextBreak(2);

        $section->addText('Tasikmalaya, ' . '2025', [
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
        $section->addText('Agung Baitul Hikmah', [], [
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

    private static function introduction($phpWord)
    {
        $section = $phpWord->addSection();
        $section->addTitle("BAB I", 1);
        $section->addTitle("PENDAHULUAN", 1);
        $section->addTitle('1.1 Latar Belakang', 2);
        Html::addHtml($section, "<p>Kegiatan ini bertujuan untuk <strong>mengenalkan budaya Jepang</strong> kepada mahasiswa serta masyarakat luas.</p>", false, false);

        $section->addTitle('1.2 Tujuan Kegiatan', 2);
        Html::addHtml($section, "<ul><li>Menambah wawasan tentang budaya Jepang.</li><li>Meningkatkan kreativitas mahasiswa.</li></ul>", false, false);

        $section->addTitle('1.3 Indikator Keberhasilan', 2);
        Html::addHtml($section, "<p>Kegiatan dinilai berhasil apabila peserta aktif mengikuti seluruh acara yang telah disiapkan.</p>", false, false);

        $footer = $section->addFooter();
        $footer->addPreserveText('{PAGE}', null, [
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
        ]);

        return $phpWord;
    }

    private static function planActivity($phpWord)
    {
        $section = $phpWord->addSection();
        $section->addTitle("BAB II", 1);
        $section->addTitle("PERENCANAAN KEGIATAN", 1);
        $section->addTitle('2.1 Nama dan Tema Kegiatan', 2);
        Html::addHtml($section, "<p>Nama kegiatan: <strong>BSI FLASH JAPANASE FESTIVAL</strong></p><p>Tema: <em>'Mengenal Jepang Lebih Dekat'</em></p>", false, false);

        $section->addTitle('2.2 Deskripsi Kegiatan', 2);
        Html::addHtml($section, "<p>Kegiatan ini mencakup berbagai acara seperti pertunjukan seni, kuliner Jepang, serta workshop kebudayaan.</p>", false, false);

        $section->addTitle('2.3 Penyelenggara Kegiatan', 2);
        Html::addHtml($section, "<p>Kegiatan ini diselenggarakan oleh <strong>Universitas BSI</strong> dengan dukungan berbagai sponsor.</p>", false, false);

        $section->addTitle('2.4 Peserta Kegiatan', 2);
        Html::addHtml($section, "<p>Peserta adalah mahasiswa dan masyarakat umum yang berminat terhadap budaya Jepang.</p>", false, false);

        $section->addTitle('2.5 Waktu Pelaksanaan', 2);
        Html::addHtml($section, "<p>Tanggal: 18 November 2023</p>", false, false);

        $section->addTitle('2.6 Susunan Acara', 2);
        Html::addHtml($section, "<ul><li>Pembukaan</li><li>Pertunjukan Seni</li><li>Workshop</li><li>Penutupan</li></ul>", false, false);

        $section->addTitle('2.7 Susunan Panitia', 2);
        Html::addHtml($section, "<p>Ketua Panitia: <strong>Agung Baitul Hikmah</strong></p>", false, false);

        $section->addTitle('2.8 Rencana Anggaran', 2);
        Html::addHtml($section, "<p>Total anggaran yang dibutuhkan adalah <strong>Rp 10.000.000,-</strong></p>", false, false);

        $footer = $section->addFooter();
        $footer->addPreserveText('{PAGE}', null, [
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
        ]);

        return $phpWord;
    }

    private static function closing($phpWord)
    {
        $section = $phpWord->addSection();
        $section->addTitle("BAB III", 1);
        $section->addTitle("PENUTUP", 1);
        Html::addHtml($section, "<p>Semoga kegiatan ini dapat berjalan dengan lancar dan memberikan manfaat bagi seluruh peserta.</p>", false, false);

        $section->addText('Tasikmalaya, 17 Oktober 2024', [], [
            'alignment' => Alignment::HORIZONTAL_RIGHT
        ]);
        $section->addText('Hormat Kami,', [], [
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);
        $table = $section->addTable();

        // Tambahkan baris pertama untuk tanda tangan
        $table->addRow();
        $cell1 = $table->addCell(4000);
        $cell2 = $table->addCell(4000);

        // Menambahkan gambar tanda tangan
        $cell1->addImage(public_path('ttd.png'), [
            'width' => 150,
            'height' => 80,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
        ]);
        $cell2->addImage(public_path('ttd.png'), [
            'width' => 150,
            'height' => 80,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
        ]);

        // Tambahkan baris kedua untuk nama dan jabatan
        $table->addRow();
        $cell1->addText('Herlan Sutisna, S.T, M.Kom' . PHP_EOL . 'Ketua Panitia', ['bold' => true], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $cell2->addText('Agung Baitul Hikmah, M.Kom' . PHP_EOL . 'Kepala Kampus', ['bold' => true], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);

        $footer = $section->addFooter();
        $footer->addPreserveText('{PAGE}', null, [
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
        ]);

        return $phpWord;
    }

    private function convertToParagraph($content)
    {
        $content = preg_replace('/<div>(.*?)<\/div>/', '<p>$1</p>', $content);
        $content = str_replace('<br>', '</p><p>', $content);

        return $content;
    }
}
