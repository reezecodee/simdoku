<?php

namespace App\Livewire\Form;

use Livewire\Attributes\Title;
use Livewire\Component;

class Formulir extends Component
{
    #[Title('Formulir Pengajuan')]

    public function createFormulir()
    {
        $this->redirect(route('form.modify', 1));
    }

    public function render()
    {
        return view('livewire.form.formulir');
    }
}
