<?php

namespace App\Livewire\Document;

use Livewire\Attributes\Title;
use Livewire\Component;

class Report extends Component
{
    #[Title('Report Kegiatan')]

    public function createReport()
    {
        $this->redirect(route('report.modify', 1));
    }

    public function render()
    {
        return view('livewire.document.report');
    }
}
