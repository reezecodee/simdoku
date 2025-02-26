<?php

namespace App\Livewire\Letter;

use App\Models\Execution;
use App\Models\LetterAssignment;
use App\Models\Staff;
use App\Models\Volunteer;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\Cell;
use PhpOffice\PhpWord\Style\Paper;

class ModifyAssignment extends Component
{
    #[Title('Buat Surat Tugas')]

    public $date;
    public $id;
    public $letter;

    public $firstIdExecutionStaff;
    public $firstIdExecutionVolunteer;

    public $executionStaffs;
    public $staffs;
    public $executionVolunteers;
    public $volunteers;

    public function mount($id)
    {
        $this->date = Carbon::now()->translatedFormat('d F Y');
        $this->id = $id;
        $this->letter = LetterAssignment::findOrFail($id);

        $this->firstIdExecutionStaff = Execution::where('surat_tugas_id', $id)->where('type', 'Staff')->first();
        $this->firstIdExecutionVolunteer = Execution::where('surat_tugas_id', $id)->where('type', 'Volunteer')->first();

        $this->executionStaffs = Execution::where('surat_tugas_id', $id)->where('type', 'Staff')->get();
        $this->staffs = Staff::where('surat_tugas_id', $id)->get();
        $this->executionVolunteers = Execution::where('surat_tugas_id', $id)->where('type', 'Volunteer')->get();
        $this->volunteers = Volunteer::where('surat_tugas_id', $id)->get();
    }

    public function printPDF()
    {
        $today = Carbon::today()->translatedFormat('d F Y');
        $path = storage_path('app/public/' . $this->letter->signature->tanda_tangan);
        $imageData = base64_encode(file_get_contents($path));
        $imageBase64 = 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . $imageData;

        $pdf = Pdf::loadView('pdf.surat-tugas', [
            'letter' => $this->letter,
            'today' => $today,
            'imgbase64' => $imageBase64,
            'executionStaffs' => $this->executionStaffs,
            'staffs' => $this->staffs,
            'executionVolunteers' => $this->executionVolunteers,
            'volunteers' => $this->volunteers,
        ]);

        return response()->streamDownload(
            function () use ($pdf) {
                echo $pdf->output();
            },
            'laporan.pdf'
        );
    }

    public function printWord()
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

        $section->addText('Tasikmalaya, 26 Februari 2024', [], ['alignment' => Alignment::HORIZONTAL_RIGHT]);
        $section->addText('Kepada Yth.', [], ['alignment' => Alignment::HORIZONTAL_LEFT]);
        $section->addText('Kepada Divisi MER Universitas Bina Sarana Informatika.', [], ['alignment' => Alignment::HORIZONTAL_LEFT]);
        $section->addText('di', [], ['alignment' => Alignment::HORIZONTAL_LEFT]);
        $textRun = $section->addTextRun(['alignment' => Alignment::HORIZONTAL_LEFT]);
        $textRun->addText("\t");
        $textRun->addText("JAKARTA", ['spacing' => 150, 'underline' => 'single']);
        $section->addText('Perihal :', [], ['alignment' => Alignment::HORIZONTAL_LEFT]);
        $section->addText('Berikut kami kirimkan pengajuan Surat Tugas kegiatan . Berikut Staf yang akan bertugas:', [], ['alignment' => Alignment::HORIZONTAL_LEFT]);

        $styleTable = [
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 70
        ];

        $table = $section->addTable($styleTable);
        
        $table->addRow();
        $table->addCell(800, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("No", [], ['alignment' => Jc::CENTER]);
        $table->addCell(1500, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("NIP", [], ['alignment' => Jc::CENTER]);
        $table->addCell(4000, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("Nama", [], ['alignment' => Jc::CENTER]);
        $table->addCell(2500, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("Sekolah", [], ['alignment' => Jc::CENTER]);
        $table->addCell(800, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("Tanggal Pelaksanaan", [], ['alignment' => Jc::CENTER]);
        
        $table->addRow();
        $cellNo = $table->addCell(800, ['vMerge' => 'restart', 'valign' => 'center']);
        $cellNo->addText("1", [], ['alignment' => Jc::CENTER]);
        
        $table->addCell(1500)->addText("200809852", [], ['alignment' => Jc::CENTER]);
        $table->addCell(3000)->addText("Agung Baitul Hikmah, S.Kom, M.Kom", [], []);
        
        $cellSekolah = $table->addCell(2500, ['vMerge' => 'restart', 'valign' => 'center']);
        $cellSekolah->addText("SMAN 10\nTasikmalaya", ['bold' => true], ['alignment' => Jc::CENTER]);
        
        $cellTanggal = $table->addCell(2500, ['vMerge' => 'restart', 'valign' => 'center']);
        $cellTanggal->addText("Selasa\n29 Oktober 2024\nPukul 07:00 – 16:00", [], ['alignment' => Jc::CENTER]);
        
        $table->addRow();
        $table->addCell(null, ['vMerge' => 'continue']); 
        $table->addCell(1500)->addText("202108186", [], ['alignment' => Jc::CENTER]);
        $table->addCell(3000)->addText("Haerul Fatah, S.Kom, M.Kom", [], []);
        $table->addCell(2500, ['vMerge' => 'continue']); 
        $table->addCell(null, ['vMerge' => 'continue']); 
        
        $table->addRow();
        $table->addCell(null, ['vMerge' => 'continue']); 
        $table->addCell(1500)->addText("201706153", [], ['alignment' => Jc::CENTER]);
        $table->addCell(3000)->addText("Herlan Sutisna, S.T, M.Kom", [], []);
        $table->addCell(2500, ['vMerge' => 'continue']); 
        $table->addCell(null, ['vMerge' => 'continue']);

        $section->addTextBreak(1);
        $section->addText('Volunteer:', ['bold' => true], ['alignment' => Alignment::HORIZONTAL_LEFT]);
        $table = $section->addTable($styleTable);
        
        $table->addRow();
        $table->addCell(800, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("No", [], ['alignment' => Jc::CENTER]);
        $table->addCell(1500, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("NIM", [], ['alignment' => Jc::CENTER]);
        $table->addCell(4000, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("Nama", [], ['alignment' => Jc::CENTER]);
        $table->addCell(2500, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("Sekolah", [], ['alignment' => Jc::CENTER]);
        $table->addCell(800, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("Tanggal Pelaksanaan", [], ['alignment' => Jc::CENTER]);
        
        $table->addRow();
        $cellNo = $table->addCell(800, ['vMerge' => 'restart', 'valign' => 'center']);
        $cellNo->addText("1", [], ['alignment' => Jc::CENTER]);
        
        $table->addCell(1500)->addText("200809852", [], ['alignment' => Jc::CENTER]);
        $table->addCell(3000)->addText("Agung Baitul Hikmah, S.Kom, M.Kom", [], []);
        
        $cellSekolah = $table->addCell(2500, ['vMerge' => 'restart', 'valign' => 'center']);
        $cellSekolah->addText("SMAN 10\nTasikmalaya", ['bold' => true], ['alignment' => Jc::CENTER]);
        
        $cellTanggal = $table->addCell(2500, ['vMerge' => 'restart', 'valign' => 'center']);
        $cellTanggal->addText("Selasa\n29 Oktober 2024\nPukul 07:00 – 16:00", [], ['alignment' => Jc::CENTER]);

        $section->addTextBreak(1);

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
            "Herlan Sutisna, S.T, M.Kom",
            ['bold' => true],
            ['alignment' => Jc::CENTER]
        );
        $cell2->addText(
            "Agung Baitul Hikmah, M.Kom",
            ['bold' => true],
            ['alignment' => Jc::CENTER]
        );

        $table->addRow();
        $cell1 = $table->addCell(5000);
        $cell2 = $table->addCell(5000);

        $cell1->addText(
            "NIP. 201706153",
            [],
            ['alignment' => Jc::CENTER]
        );
        $cell2->addText(
            "NIP. 201706153",
            [],
            ['alignment' => Jc::CENTER]
        );

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

    public function render()
    {
        return view('livewire.letter.modify-assignment');
    }
}
