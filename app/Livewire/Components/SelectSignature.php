<?php

namespace App\Livewire\Components;

use App\Models\LetterAssignment;
use App\Models\Proposal;
use App\Models\Report;
use App\Models\Signature;
use Livewire\Component;

class SelectSignature extends Component
{
    public $id;
    public $doc;
    public $signature;
    public $functionName;
    public $relationName = 'signature';

    public $letter = null;
    public $proposal = null;
    public $report = null;

    public function mount()
    {
        if($this->doc === 'letter'){
            $this->letter = LetterAssignment::findOrFail($this->id);
        }else if($this->doc === 'proposal'){
            $this->proposal = Proposal::findOrFail($this->id);
        }else if($this->doc === 'report'){
            $this->report = Report::findOrFail($this->id);
        }
    }

    public function updateSignatureMarkom($field, $value)
    {
        if ($this->letter) {
            $this->letter->$field = $value;
            $this->letter->save();
        }
    }

    public function updateSignatureLeadCommittee($field, $value)
    {
        if ($this->proposal) {
            $this->proposal->$field = $value;
            $this->proposal->save();
        }
    }

    public function updateSignatureChiefExecutive($field, $value)
    {
        if ($this->report) {
            $this->report->$field = $value;
            $this->report->save();
        }
    }

    public function updateSignatureKaDivMER($field, $value)
    {
        if ($this->report) {
            $this->report->$field = $value;
            $this->report->save();
        }
    }

    public function render()
    {
        $signatures = Signature::all();

        return view('livewire.components.select-signature', compact('signatures'));
    }
}
