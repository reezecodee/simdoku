<?php

namespace App\Livewire\Letter;

use App\Models\Execution;
use App\Models\LetterAssignment;
use App\Models\Profile;
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

class ModifyAssignment extends Component
{
    #[Title('Buat Surat Tugas')]

    public $date;
    public $id;
    public $letter;
    public $path;
    public $profile;

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
        $this->letter = LetterAssignment::findOrFail($id); //
        $this->path = storage_path('app/public/' . $this->letter->signature->tanda_tangan);
        $this->profile = Profile::first();

        $this->firstIdExecutionStaff = Execution::where('surat_tugas_id', $id)->where('type', 'Staff')->first();
        $this->firstIdExecutionVolunteer = Execution::where('surat_tugas_id', $id)->where('type', 'Volunteer')->first();

        $this->executionStaffs = Execution::where('surat_tugas_id', $id)->where('type', 'Staff')->get();
        $this->staffs = Staff::where('surat_tugas_id', $id)->get();
        $this->executionVolunteers = Execution::where('surat_tugas_id', $id)->where('type', 'Volunteer')->get();
        $this->volunteers = Volunteer::where('surat_tugas_id', $id)->get();
    }

    public function printPDF()
    {
        $today = $this->date;
        $imageData = base64_encode(file_get_contents($this->path));
        $imageBase64 = 'data:image/' . pathinfo($this->path, PATHINFO_EXTENSION) . ';base64,' . $imageData;

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

        $section->addText("Tasikmalaya, {$this->date}", [], ['alignment' => Alignment::HORIZONTAL_RIGHT]);
        $section->addText('Kepada Yth.', [], ['alignment' => Alignment::HORIZONTAL_LEFT]);
        $section->addText('Kepada Divisi MER Universitas Bina Sarana Informatika.', [], ['alignment' => Alignment::HORIZONTAL_LEFT]);
        $section->addText($this->letter->kepala_devisi_mer, [], ['alignment' => Alignment::HORIZONTAL_LEFT]);
        $section->addText('di', [], ['alignment' => Alignment::HORIZONTAL_LEFT]);
        $textRun = $section->addTextRun(['alignment' => Alignment::HORIZONTAL_LEFT]);
        $textRun->addText("\t");
        $textRun->addText("JAKARTA", ['spacing' => 150, 'underline' => 'single']);
        $section->addText("Perihal: {$this->letter->perihal}", [], ['alignment' => Alignment::HORIZONTAL_LEFT]);
        $section->addText("Berikut kami kirimkan pengajuan Surat Tugas kegiatan {$this->letter->nama_acara}. Berikut Staf yang akan bertugas:", [], ['alignment' => Alignment::HORIZONTAL_LEFT]);

        $styleTable = [
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 70
        ];

        if ($this->executionStaffs->isNotEmpty()) {
            $table = $section->addTable($styleTable);

            $table->addRow();
            $table->addCell(800, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("No", [], ['alignment' => Jc::CENTER]);
            $table->addCell(1500, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("NIP", [], ['alignment' => Jc::CENTER]);
            $table->addCell(4000, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("Nama", [], ['alignment' => Jc::CENTER]);
            $table->addCell(2500, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("Sekolah", [], ['alignment' => Jc::CENTER]);
            $table->addCell(2500, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("Tanggal Pelaksanaan", [], ['alignment' => Jc::CENTER]);

            foreach ($this->executionStaffs as $index => $execution) {
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
        }

        if ($this->executionVolunteers->isNotEmpty()) {
            $section->addText('Volunteer:', ['bold' => true], ['alignment' => Alignment::HORIZONTAL_LEFT]);

            $table = $section->addTable($styleTable);

            $table->addRow();
            $table->addCell(800, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("No", [], ['alignment' => Jc::CENTER]);
            $table->addCell(1500, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("NIM", [], ['alignment' => Jc::CENTER]);
            $table->addCell(4000, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("Nama", [], ['alignment' => Jc::CENTER]);
            $table->addCell(2500, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("Sekolah", [], ['alignment' => Jc::CENTER]);
            $table->addCell(2500, ['valign' => 'center', 'bgColor' => 'D9D9D9'])->addText("Tanggal Pelaksanaan", [], ['alignment' => Jc::CENTER]);

            foreach ($this->executionVolunteers as $index => $execution) {
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
        }

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

        $cell1->addImage($this->path, [
            'width' => 110,
            'height' => 50,
            'alignment' => Jc::CENTER
        ]);
        $cell2->addImage(storage_path('app/public/' . $this->profile->tanda_tangan), [
            'width' => 110,
            'height' => 50,
            'alignment' => Jc::CENTER
        ]);

        $table->addRow();
        $cell1 = $table->addCell(5000);
        $cell2 = $table->addCell(5000);

        $cell1->addText(
            $this->letter->signature->nama_pemilik,
            ['bold' => true],
            ['alignment' => Jc::CENTER]
        );
        $cell2->addText(
            $this->profile->nama,
            ['bold' => true],
            ['alignment' => Jc::CENTER]
        );

        $table->addRow();
        $cell1 = $table->addCell(5000);
        $cell2 = $table->addCell(5000);

        $cell1->addText(
            "NIP. {$this->letter->signature->nip}",
            [],
            ['alignment' => Jc::CENTER]
        );
        $cell2->addText(
            "NIP. {$this->profile->nip}",
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
