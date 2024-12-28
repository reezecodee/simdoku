<?php

namespace App\Livewire\Form;

use Livewire\Attributes\Title;
use Livewire\Component;

class ModifyFormulir extends Component
{
    #[Title('Modify Formulir Kegiatan')]

    public function render()
    {
        return view('livewire.form.modify-formulir');
    }
}
