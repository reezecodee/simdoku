<?php

namespace App\Livewire\Document;

use App\Models\Proposal;
use Dompdf\Dompdf;
use Dompdf\Options;
use Livewire\Attributes\Title;
use Livewire\Component;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class ModifyProposal extends Component
{
    #[Title('Modify Proposal Kegiatan')]

    public $judul, $tahun, $kata_pengantar, $penutup;

    public $id;
    public $proposal;

    public function mount($id)
    {
        $this->id = $id;
        $this->proposal = Proposal::findOrFail($id);
        $this->judul = $this->proposal->judul ?? '';
        $this->tahun = $this->proposal->tahun ?? '';
        $this->kata_pengantar = $this->proposal->kata_pengantar ?? '';
        $this->penutup = $this->proposal->penutup ?? '';
    }

    public function updated($property, $value)
    {
        $this->proposal->update([
            $property => $value
        ]);
    }

    public function generateWord()
    {
        $phpWord = new PhpWord();
    }

    public function createWordDocument()
    {
        // Membuat instance PHPWord
        $phpWord = new PhpWord();

        // Menambahkan Section baru
        $section = $phpWord->addSection();

        // Menambahkan Judul untuk Daftar Isi
        $section->addTitle('Daftar Isi', 1);

        // Menambahkan Heading yang akan digunakan dalam daftar isi
        $section->addTitle('LEMBAR JUDUL', 2); // Heading 2
        $section->addTitle('KATA PENGANTAR', 2); // Heading 2
        $section->addTitle('DAFTAR ISI', 2); // Heading 2
        $section->addTitle('BAB I PENDAHULUAN', 2); // Heading 2
        $section->addTitle('1.1 Latar Belakang', 3); // Heading 3
        $section->addTitle('1.2 Tujuan Kegiatan', 3); // Heading 3
        $section->addTitle('1.3 Manfaat Kegiatan', 3); // Heading 3
        $section->addTitle('1.4 Indikator Keberhasilan', 3); // Heading 3

        // Menambahkan Daftar Isi Otomatis
        $section->addText('Daftar Isi di bawah ini akan otomatis dibuat berdasarkan Heading yang telah ditambahkan.');
        $section->addTextBreak(1);

        // Menambahkan TOC (Table of Contents) untuk daftar isi otomatis
        $section->addTOC();

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
