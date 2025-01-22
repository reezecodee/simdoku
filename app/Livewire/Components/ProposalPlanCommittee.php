<?php

namespace App\Livewire\Components;

use App\Models\ProposalPlanCommittee as PPC;
use Livewire\Component;

class ProposalPlanCommittee extends Component
{
    public $id;

    public function addCommittee()
    {
        PPC::create([
            'proposal_id' => $this->id
        ]);
    }

    public function deleteCommittee($id)
    {
        $committee = PPC::findOrFail($id);
        $committee->delete();
    }

    public function updateCommittee($id, $field, $value)
    {
        $committee = PPC::findOrFail($id);

        if ($committee) {
            $committee->$field = $value;
            $committee->save();
        }
    }

    public function render()
    {
        $planCommittees = PPC::where('proposal_id', $this->id)->get();

        return view('livewire.components.proposal-plan-committe', compact('planCommittees'));
    }
}
