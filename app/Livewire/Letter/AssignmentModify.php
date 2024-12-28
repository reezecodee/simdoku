<?php

namespace App\Livewire\Letter;

use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Title;
use Livewire\Component;

class AssignmentModify extends Component
{
    #[Title('Buat Surat Tugas')]
    
    public function downloadPDF()
    {
        $pdf = Pdf::loadView('pdf.surat-tugas');

        return response()->streamDownload(
            fn() => print($pdf->stream()), 'laporan.pdf'
        );
    }

    public function render()
    {
        return view('livewire.letter.assignment-modify');
    }
}
