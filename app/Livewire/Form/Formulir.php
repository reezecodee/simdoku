<?php

namespace App\Livewire\Form;

use Livewire\Attributes\Title;
use Livewire\Component;

class Formulir extends Component
{
    #[Title('Formulir Pengajuan')]

    public function render()
    {
        return view('livewire.form.formulir');
    }
}
