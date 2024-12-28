<?php

namespace App\Livewire\Document;

use Livewire\Attributes\Title;
use Livewire\Component;

class Report extends Component
{
    #[Title('Report Kegiatan')]

    public function render()
    {
        return view('livewire.document.report');
    }
}
