<?php

namespace App\Livewire\Letter;

use App\Models\LetterAssignment;
use Livewire\Attributes\Title;
use Livewire\Component;

class Assignment extends Component
{
    #[Title('Surat Tugas')]

    public function createLetterAssigment()
    {
        $letter = LetterAssignment::create([]);
        $this->redirect(route('letter.modify', $letter->id));
    }

    public function render()
    {
        return view('livewire.letter.assignment');
    }
}
