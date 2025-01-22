<?php

namespace App\Livewire\Components;

use App\Models\ProposalPlanSchedule as PPS;
use Livewire\Component;

class ProposalPlanSchedule extends Component
{
    public $id;

    public function addActivity()
    {
        PPS::create([
            'proposal_id' => $this->id
        ]);
    }

    public function deleteActivity($id)
    {
        $activity = PPS::findOrFail($id);
        $activity->delete();
    }

    public function updateSchedule($id, $field, $value)
    {
        $schedule = PPS::findOrFail($id);

        if ($schedule) {
            $schedule->$field = $value;
            $schedule->save();
        }
    }

    public function render()
    {
        $planSchedules = PPS::where('proposal_id', $this->id)->get();

        return view('livewire.components.proposal-plan-schedule', compact('planSchedules'));
    }
}
