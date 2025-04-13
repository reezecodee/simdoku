<?php

namespace App\Livewire\Components;

use App\Models\Formulir;
use App\Models\LetterAssignment;
use App\Models\Proposal;
use App\Models\Report;
use App\Models\Scholarship;
use Livewire\Component;

class SearchDocument extends Component
{
    public string $query = '';

    public function render()
    {
        $search = '%' . $this->query . '%';

        return view('livewire.components.search-document', [
            'letters' => LetterAssignment::where('perihal', 'like', $search)->limit(3)->get(),
            'proposals' => Proposal::where('judul', 'like', $search)->limit(3)->get(),
            'reports' => Report::where('judul', 'like', $search)->limit(3)->get(),
            'scholarships' => Scholarship::where('nama', 'like', $search)->limit(3)->get(),
            'formulirs' => Formulir::where('judul', 'like', $search)->limit(3)->get(),
        ]);
    }
}
