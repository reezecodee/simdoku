<?php

namespace App\Livewire\Dashboard;

use App\Models\Formulir;
use App\Models\LetterAssignment;
use App\Models\Proposal;
use App\Models\Report;
use App\Models\Scholarship;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('Dashboard')]

    public $title = 'Dashboard';
    public $scholarship, $letter, $proposal, $report, $formulir;

    public function mount()
    {
        $this->scholarship = Scholarship::count();
        $this->letter = LetterAssignment::count();
        $this->proposal = Proposal::count();
        $this->report = Report::count();
        $this->formulir = Formulir::count();
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
