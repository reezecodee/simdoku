<?php

namespace App\Livewire\Scholarship;

use Livewire\Attributes\Title;
use Livewire\Component;

class Scholarship extends Component
{
    #[Title('Daftar Beasiswa')]

    public function render()
    {
        return view('livewire.scholarship.scholarship');
    }
}
