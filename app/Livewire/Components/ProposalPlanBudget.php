<?php

namespace App\Livewire\Components;

use App\Models\ProposalBudgetPlan as PPB;
use Livewire\Component;

class ProposalPlanBudget extends Component
{
    public $id;

    public function addBudget()
    {
        PPB::create([
            'proposal_id' => $this->id
        ]);
    }

    public function deleteBudget($id)
    {
        $budget = PPB::findOrFail($id);
        $budget->delete();
    }

    public function updateBudget($id, $field, $value)
    {
        $budget = PPB::findOrFail($id);

        if ($budget) {
            $budget->$field = $value;
            $budget->save();
        }
    }

    public function render()
    {
        $planBudgets = PPB::where('proposal_id', $this->id)->get();
        $total = PPB::where('proposal_id', $this->id)->sum('total');

        return view('livewire.components.proposal-plan-budget', compact('planBudgets', 'total'));
    }
}
