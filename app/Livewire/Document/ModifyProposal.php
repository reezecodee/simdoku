<?php

namespace App\Livewire\Document;

use App\Models\Proposal;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Livewire\Attributes\Title;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class ModifyProposal extends Component
{
    #[Title('Modify Proposal Kegiatan')]

    public $judul, $tahun, $kata_pengantar, $penutup;

    public $id;
    public $proposal;
    public $date;

    public function mount($id)
    {
        $this->id = $id;
        $this->proposal = Proposal::findOrFail($id);
        $this->judul = $this->proposal->judul ?? '';
        $this->tahun = $this->proposal->tahun ?? '';
        $this->kata_pengantar = $this->proposal->kata_pengantar ?? '';
        $this->penutup = $this->proposal->penutup ?? '';
        $this->date = Carbon::now()->translatedFormat('d F Y');
    }

    public function updated($property)
    {
        $this->proposal->update([
            $property => $this->$property
        ]);
    }

    public function createWordDocument()
    {
        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);
        $phpWord->setDefaultParagraphStyle([
            'alignment' => Alignment::HORIZONTAL_LEFT,
            'lineHeight' => 1.5,
            'spaceAfter' => 240,
        ]);
        $phpWord->addTitleStyle(
            1,
            ['bold' => true, 'size' => 14],
            ['alignment' => Alignment::HORIZONTAL_CENTER]
        );
        $phpWord->addTitleStyle(
            2,
            ['bold' => true, 'size' => 12],
            ['alignment' => Alignment::HORIZONTAL_LEFT]
        );

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

        $section = $phpWord->addSection();
        $section->addTitle('KATA PENGANTAR', 1);
        $section->addText('Assalamualaikum WR WB', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);
        $section->addText('Alhamdulillahi rabbil„alamin, dengan segala kerendahan hati, kami panjatkan puji dan syukur kehadirat Allah SWT, karena atas izin, rahmat serta hidayah Nya, proposal acara kegiatan Festival Budaya Jepang di Universitas Bina Sarana Informatika dengan tema “BSI FLASH JAPANASE FESTIVAL” telah selesai disusun.', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);
        $section->addText('Proposal ini disusun berdasarkan rencana pelaksanaan kegiatan Panitia BSI FLASH JAPANASE FESTIVAL, yang dimana akan dilaksanakan pada tanggal 18 November 2023. Kami menyadari, terselesaikannya proposal ini tidak terlepas dari bantuan berbagai pihak, sehingga sepatutnya kami menghaturkan rasa terima kasih kepada seluruh pihak terkait yang telah memberikan bantuan', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);
        $section->addText('Dalam penyajian proposal ini kami tentu menyadari masih belum mendekati kesempurnaan. Oleh karena itu, besar harapan kami agar pembaca berkenan memberikan umpan balik berupa kritik dan saran yang sifatnya membangun demi terciptanya proposal yang lebih baik lagi di masa mendatang. Sebab tidak ada sesuatu yang sempurna tanpa disertai saran yang konstruktif. Akhir kata, semoga makalah ini bisa memberikan manfaat bagi berrbagai pihak. Aamiin.', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);
        $section->addText('Wassalamualakium WR WB', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);

        $section->addTextBreak(2);

        $section->addText('Tasikmalaya, ' . $this->date, [], [
            'alignment' => Alignment::HORIZONTAL_RIGHT
        ]);
        $section->addText('Penyusun', [], [
            'indentation' => ['right' => 800],
            'alignment' => Alignment::HORIZONTAL_RIGHT
        ]);
        $section->addTextBreak(1);
        $section->addText('Agung Baitul Hikmah', [], [
            'indentation' => ['right' => 390],
            'alignment' => Alignment::HORIZONTAL_RIGHT
        ]);

        $section = $phpWord->addSection();
        $section->addTitle('DAFTAR ISI', 1);
        $section->addTOC();

        $section = $phpWord->addSection();
        $section->addTitle("BAB I \nPENDAHULUAN", 1);
        $section->addTitle('1.1 Latar Belakang', 2);
        $section->addText('Maraknya acara/event yang sudah berlangsung di wilayah kota kota indonesia, membuat kami termotifasi ingin membuat acara tersebut di wilayah Tasikmalaya. Maka dari itu kami dari Markom bekerjasama dengan volunteer dari mahasiswa Universitas Bina Sarana Informatika Kmapus Tasikmalaya ingin mengadakan acara tersebut untuk memeriahkan sekaligus mengisi kegiatan rutinitas kami dalam bidang budaya dan seni sekaligus memperkenalkan kampus kami dan sebagai upaya strategi markom branding dan Beasiswa BJU PMB UBSI 2025.', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);
        $section->addTitle('1.2 Tujuan Kegiatan', 2);
        $section->addText('Maraknya acara/event yang sudah berlangsung di wilayah kota kota indonesia, membuat kami termotifasi ingin membuat acara tersebut di wilayah Tasikmalaya. Maka dari itu kami dari Markom bekerjasama dengan volunteer dari mahasiswa Universitas Bina Sarana Informatika Kmapus Tasikmalaya ingin mengadakan acara tersebut untuk memeriahkan sekaligus mengisi kegiatan rutinitas kami dalam bidang budaya dan seni sekaligus memperkenalkan kampus kami dan sebagai upaya strategi markom branding dan Beasiswa BJU PMB UBSI 2025.', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);
        $section->addTitle('1.3 Indikator Keberhasilan', 2);
        $section->addText('Maraknya acara/event yang sudah berlangsung di wilayah kota kota indonesia, membuat kami termotifasi ingin membuat acara tersebut di wilayah Tasikmalaya. Maka dari itu kami dari Markom bekerjasama dengan volunteer dari mahasiswa Universitas Bina Sarana Informatika Kmapus Tasikmalaya ingin mengadakan acara tersebut untuk memeriahkan sekaligus mengisi kegiatan rutinitas kami dalam bidang budaya dan seni sekaligus memperkenalkan kampus kami dan sebagai upaya strategi markom branding dan Beasiswa BJU PMB UBSI 2025.', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);

        $section = $phpWord->addSection();
        $section->addTitle("BAB II \PERENCANAAN KEGIATAN", 1);
        $section->addTitle('2.1 Nama dan Tema Kegiatan', 2);
        $section->addText('Tema Kegiatan ini adalah “BSI FLASH JAPANASE FESTIVAL ”', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);
        $section->addTitle('2.2 Deskripsi Kegiatan', 2);
        $section->addText('Maraknya acara/event yang sudah berlangsung di wilayah kota kota indonesia, membuat kami termotifasi ingin membuat acara tersebut di wilayah Tasikmalaya. Maka dari itu kami dari Markom bekerjasama dengan volunteer dari mahasiswa Universitas Bina Sarana Informatika Kmapus Tasikmalaya ingin mengadakan acara tersebut untuk memeriahkan sekaligus mengisi kegiatan rutinitas kami dalam bidang budaya dan seni sekaligus memperkenalkan kampus kami dan sebagai upaya strategi markom branding dan Beasiswa BJU PMB UBSI 2025.', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);
        $section->addTitle('2.3 Penyelenggara Kegiatan', 2);
        $section->addText('Kegiatan ini diselenggarakan oleh Markom bekerjasama dengan mahasiswa Universitas Bina Sarana Informatika Kampus Kota Tasikmalaya.', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);
        $section->addTitle('2.4 Peserta Kegiatan', 2);
        $section->addText('Sasaran dari kegiatan ini adalah SMA/SMK Sederajat di Wilayah Priangan Timur (Kabupaten Garut, Kabupaten Tasikmalaya, Kota Tasikmalaya, Kabupaten Ciamis, Kota Banjar, Kabupaten Pangandaran);', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);
        $section->addTitle('2.5 Waktu Pelaksanaan', 2);
        $section->addText('Sasaran dari kegiatan ini adalah SMA/SMK Sederajat di Wilayah Priangan Timur (Kabupaten Garut, Kabupaten Tasikmalaya, Kota Tasikmalaya, Kabupaten Ciamis, Kota Banjar, Kabupaten Pangandaran);', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);
        $section->addTitle('2.6 Susunan Acara', 2);
        $section->addText('Sasaran dari kegiatan ini adalah SMA/SMK Sederajat di Wilayah Priangan Timur (Kabupaten Garut, Kabupaten Tasikmalaya, Kota Tasikmalaya, Kabupaten Ciamis, Kota Banjar, Kabupaten Pangandaran);', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);
        $section->addTitle('2.7 Susunan Panitia', 2);
        $section->addText('Sasaran dari kegiatan ini adalah SMA/SMK Sederajat di Wilayah Priangan Timur (Kabupaten Garut, Kabupaten Tasikmalaya, Kota Tasikmalaya, Kabupaten Ciamis, Kota Banjar, Kabupaten Pangandaran);', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);
        $section->addTitle('2.8 Rencana Anggaran', 2);
        $section->addText('Sasaran dari kegiatan ini adalah SMA/SMK Sederajat di Wilayah Priangan Timur (Kabupaten Garut, Kabupaten Tasikmalaya, Kota Tasikmalaya, Kabupaten Ciamis, Kota Banjar, Kabupaten Pangandaran);', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);

        $section = $phpWord->addSection();
        $section->addTitle("BAB III \nPENUTUP", 1);
        $section->addText('Demikian proposal ini disusun sebagai dasar dan bahan pertimbangan bagi pelaksanaan kegiatan yang dimaksud, diharapkan menjadi kegiatan yang bermanfaat bagi semua yang telah mendukung dan berpartisipasi didalamnya. Atas segala perhatian dan kerjasama Bapak/Ibu kami ucapkan terima kasih.', [], [
            'indentation' => ['firstLine' => 480],
            'alignment' => Alignment::HORIZONTAL_LEFT
        ]);
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

        // Membuat file Word dalam format .docx di memori
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

        // Mengoutputkan file ke browser
        $fileName = 'surat_tugas.docx';
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

    public function generatePDF()
    {
        // HTML dengan page break
        $html = view('pdf.pdf_template')->render();

        // Konfigurasi DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true); // Enable HTML5 parsing
        $options->set('isPhpEnabled', true); // Enable PHP functions if needed
        $dompdf = new Dompdf($options);

        // Memuat HTML ke DOMPDF
        $dompdf->loadHtml($html);

        // Menentukan ukuran kertas
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF ke browser
        return response()->streamDownload(
            function () use ($dompdf) {
                echo $dompdf->output();
            },
            'surat-tugas.pdf'
        );
    }

    public function render()
    {
        return view('livewire.document.modify-proposal');
    }
}
