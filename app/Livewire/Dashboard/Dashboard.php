<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('Dashboard')]

    public $title = 'Dashboard';

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
