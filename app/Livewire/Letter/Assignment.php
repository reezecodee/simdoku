<?php

namespace App\Livewire\Letter;

use Livewire\Attributes\Title;
use Livewire\Component;

class Assignment extends Component
{
    #[Title('Surat Tugas')]

    public function createLetterAssigment()
    {
        $this->redirect(route('letter.modify', 1));
    }

    public function render()
    {
        return view('livewire.letter.assignment');
    }
}
