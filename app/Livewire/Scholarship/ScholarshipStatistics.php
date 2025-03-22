<?php

namespace App\Livewire\Scholarship;

use Livewire\Attributes\Title;
use Livewire\Component;

class ScholarshipStatistics extends Component
{
    #[Title('Statistik Beasiswa')]

    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }
    
    public function render()
    {
        return view('livewire.scholarship.scholarship-statistics');
    }
}
