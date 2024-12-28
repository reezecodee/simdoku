<?php

namespace App\Livewire\Document;

use Livewire\Attributes\Title;
use Livewire\Component;

class Proposal extends Component
{
    #[Title('Proposal Kegiatan')]
    
    public function render()
    {
        return view('livewire.document.proposal');
    }
}
