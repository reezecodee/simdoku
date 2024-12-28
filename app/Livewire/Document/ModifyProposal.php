<?php

namespace App\Livewire\Document;

use Livewire\Attributes\Title;
use Livewire\Component;

class ModifyProposal extends Component
{
    #[Title('Modify Proposal Kegiatan')]

    public function render()
    {
        return view('livewire.document.modify-proposal');
    }
}
