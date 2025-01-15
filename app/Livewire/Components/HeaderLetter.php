<?php

namespace App\Livewire\Components;

use App\Models\LetterAssignment;
use Livewire\Component;

class HeaderLetter extends Component
{
    public $id;

    public $letter;

    public $kepala_devisi_mer;
    public $perihal;
    public $nama_acara;

    public function mount()
    {
        $this->letter = LetterAssignment::findOrFail($this->id);
        $this->kepala_devisi_mer = $this->letter->kepala_devisi_mer;
        $this->perihal = $this->letter->perihal;
        $this->nama_acara = $this->letter->nama_acara;
    }

    public function updated($property, $value)
    {
        $this->letter->update([
            $property => $value
        ]);
    }

    public function render()
    {
        return view('livewire.components.header-letter');
    }
}
