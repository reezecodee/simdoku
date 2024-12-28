<?php

namespace App\Livewire\Document;

use Livewire\Attributes\Title;
use Livewire\Component;

class ModifyReport extends Component
{
    #[Title('Modify Laporan Kegiatan')]

    public function render()
    {
        return view('livewire.document.modify-report');
    }
}
