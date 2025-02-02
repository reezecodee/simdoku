<?php

namespace App\Livewire\Components;

use App\Models\Formulir;
use App\Models\Signature;
use Livewire\Component;

class SignatureFormulir extends Component
{
    public $id, $as, $position, $functionName, $signature, $relation = 'signature';
    public $formulir;

    public function mount()
    {
        $this->formulir = Formulir::findOrFail($this->id);
    }

    public function updateKaDivMER($field, $value)
    {
        if ($this->formulir) {
            $this->formulir->$field = $value;
            $this->formulir->save();
        }
    }

    public function updateKaBaku($field, $value)
    {
        if ($this->formulir) {
            $this->formulir->$field = $value;
            $this->formulir->save();
        }
    }

    public function render()
    {
        $signatures = Signature::where('status', $this->position)->get();

        return view('livewire.components.signature-formulir', compact('signatures'));
    }
}
