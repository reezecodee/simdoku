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

class ModifyAssignment extends Component
{
    #[Title('Buat Surat Tugas')]

    public $date;
    public $id;

    public $fields = [];
    public $staff = [];
    public $listVolunteer = [];
    public $executions = [];

    public $kepala_devisi_mer;
    public $perihal;
    public $nama_acara;
    public $ttd_markom_id;
    public $nip_markom;

    public function mount($id)
    {
        $this->date = Carbon::now()->translatedFormat('d F Y');
        $this->id = $id;

        $letter = LetterAssignment::findOrFail($id);

        $this->fields = [
            'kepala_devisi_mer' => $letter->kepala_devisi_mer,
            'perihal' => $letter->perihal,
            'nama_acara' => $letter->nama_cara,
            'ttd_markom_id' => $letter->ttd_markom_id,
            'nip_markom' => $letter->nip_markom
        ];

        $this->executions = [
            [
                'id' => null,
                'nama_sekolah' => '',
                'tgl_pelaksanaan' => '',
                'staff' => [],
                'volunteers' => [],
            ],
        ];
    }

    public function updateFields($value, $key)
    {
        $this->validate([
            "fields.$key" => 'nullable'
        ]);

        LetterAssignment::where('id', $this->id)->update([
            $key => $value
        ]);

        $this->dispatchBrowserEvent('notify-saved');
    }

    public function updated($propertyName)
    {
        $keys = explode('.', $propertyName);

        if ($keys[0] === 'executions') {
            $executionIndex = $keys[1];
            $executionData = $this->executions[$executionIndex];

            $execution = Execution::updateOrCreate(
                ['id' => $executionData['id'] ?? null],
                [
                    'surat_tugas_id' => $this->id,
                    'nama_sekolah' => $executionData['nama_sekolah'],
                    'tgl_pelaksanaan' => $executionData['tgl_pelaksanaan'],
                ]
            );

            $this->executions[$executionIndex]['id'] = $execution->id;

            if (isset($keys[2]) && $keys[2] === 'staff') {
                $staffIndex = $keys[3];
                $staffData = $executionData['staff'][$staffIndex];

                Staff::updateOrCreate(
                    ['id' => $staffData['id'] ?? null],
                    [
                        'pelaksanaan_id' => $execution->id,
                        'nip' => $staffData['nip'],
                        'nama' => $staffData['nama'],
                    ]
                );
            }

            if (isset($keys[2]) && $keys[2] === 'volunteers') {
                $volunteerIndex = $keys[3];
                $volunteerData = $executionData['volunteers'][$volunteerIndex];

                Volunteer::updateOrCreate(
                    ['id' => $volunteerData['id'] ?? null],
                    [
                        'pelaksanaan_id' => $execution->id,
                        'nim' => $volunteerData['nim'],
                        'nama' => $volunteerData['nama'],
                    ]
                );
            }
        }
    }

    public function addStaff($executionIndex)
    {
        $this->executions[$executionIndex]['staff'][] = ['nip' => '', 'nama' => ''];
    }

    public function addVolunteer($executionIndex)
    {
        $this->executions[$executionIndex]['volunteers'][] = ['nim' => '', 'nama' => '',];
    }


    public function generatePdf()
    {
        include(public_path('jpgraph/src/jpgraph.php'));
        include(public_path('jpgraph/src/jpgraph_pie.php'));

        $data = [10, 20, 30, 40];
        $labels = ['January', 'February', 'March', 'April'];

        $graph = new \PieGraph(400, 300);
        $graph->SetShadow();

        $p1 = new \PiePlot($data);
        $p1->SetLegends($labels);

        $graph->Add($p1);
        $graph->Stroke(public_path('charts/piechart.png'));

        $imagePath = public_path('charts/piechart.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $image = '<img src="data:image/png;base64,' . $imageData . '" alt="Pie Chart">';

        $pdf = Pdf::loadView('pdf.surat-tugas', [
            'image' => $image
        ]);

        return response()->streamDownload(
            function () use ($pdf, $imagePath) {
                print($pdf->stream());
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            },
            'laporan.pdf'
        );    
    }


    public function render()
    {
        return view('livewire.letter.modify-assignment');
    }
}
