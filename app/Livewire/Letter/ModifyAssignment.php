<?php

namespace App\Livewire\Letter;

use App\Models\Execution;
use App\Models\LetterAssignment;
use App\Models\Staff;
use App\Models\Volunteer;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

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

    // public function generatePdf()
    // {
    //     include(public_path('jpgraph/src/jpgraph.php'));
    //     include(public_path('jpgraph/src/jpgraph_pie.php'));

    //     $data = [10, 20, 30, 40];
    //     $labels = ['January', 'February', 'March', 'April'];

    //     $graph = new \PieGraph(400, 300);
    //     $graph->SetShadow();

    //     $p1 = new \PiePlot($data);
    //     $p1->SetLegends($labels);

    //     $graph->Add($p1);
    //     $graph->Stroke(public_path('charts/piechart.png'));

    //     $imagePath = public_path('charts/piechart.png');
    //     $imageData = base64_encode(file_get_contents($imagePath));
    //     $image = '<img src="data:image/png;base64,' . $imageData . '" alt="Pie Chart">';

    //     $pdf = Pdf::loadView('pdf.surat-tugas', [
    //         'image' => $image
    //     ]);

    //     return response()->streamDownload(
    //         function () use ($pdf, $imagePath) {
    //             print($pdf->stream());
    //             if (file_exists($imagePath)) {
    //                 unlink($imagePath);
    //             }
    //         },
    //         'laporan.pdf'
    //     );    
    // }

    public function printPDF()
    {
        $today = Carbon::today()->translatedFormat('d F Y');
        $path = storage_path('app/public/'.$this->letter->signature->tanda_tangan);
        $imageData = base64_encode(file_get_contents($path));
        $imageBase64 = 'data:image/'.pathinfo($path, PATHINFO_EXTENSION).';base64,'.$imageData;
        
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

    public function render()
    {
        return view('livewire.letter.modify-assignment');
    }
}
