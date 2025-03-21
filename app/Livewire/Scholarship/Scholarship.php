<?php

namespace App\Livewire\Scholarship;

use App\Models\Scholarship as ModelsScholarship;
use Livewire\Attributes\Title;
use Livewire\Component;

class Scholarship extends Component
{
    #[Title('Daftar Beasiswa')]

    public function createScholarship()
    {
        $scholarship = ModelsScholarship::create([]);
        $this->redirect(route('scholarship.modify', $scholarship->id));
    }

    public function render()
    {
        return view('livewire.scholarship.scholarship');
    }
}
