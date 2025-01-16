<?php

namespace App\Livewire\Form;

use App\Models\Formulir as FM;
use Livewire\Attributes\Title;
use Livewire\Component;

class Formulir extends Component
{
    #[Title('Formulir Pengajuan')]

    public function createFormulir()
    {
        $form = FM::create([]);
        $this->redirect(route('form.modify', $form->id));
    }

    public function render()
    {
        return view('livewire.form.formulir');
    }
}
