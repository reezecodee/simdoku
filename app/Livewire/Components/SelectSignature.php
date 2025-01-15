<?php

namespace App\Livewire\Components;

use App\Models\LetterAssignment;
use App\Models\Signature;
use Livewire\Component;

class SelectSignature extends Component
{
    public $type;
    public $id;

    public $letter;

    public function mount()
    {
        $this->letter = LetterAssignment::findOrFail($this->id);
    }

    public function updateSignatureMarkom($field, $value)
    {
        if ($this->letter) {
            $this->letter->$field = $value;
            $this->letter->save();
        }
    }

    public function render()
    {
        $signatures = Signature::where('status', $this->type)->get();

        return view('livewire.components.select-signature', compact('signatures'));
    }
}
