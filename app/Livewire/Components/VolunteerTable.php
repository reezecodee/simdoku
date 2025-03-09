<?php

namespace App\Livewire\Components;

use App\Models\Execution;
use App\Models\Volunteer;
use Livewire\Component;

class VolunteerTable extends Component
{
    public $executionVolunteers;
    public $volunteers;
    public $id;

    public $letterId;
    public $firstIdExecutionVolunteer;
    public $selectedExecutionId;

    public function mount()
    {
        $this->selectedExecutionId = null;
        $this->executionVolunteers = Execution::where('surat_tugas_id', $this->letterId)->where('type', 'Volunteer')->get();
        $this->volunteers = Volunteer::where('surat_tugas_id', $this->letterId)->get();
    }

    public function addExecutionVolunteer($id, $type = 'Volunteer')
    {
        Execution::create([
            'surat_tugas_id' => $id,
            'type' => $type
        ]);

        $this->executionVolunteers = Execution::where('surat_tugas_id', $id)->where('type', $type)->get();
    }

    public function addVolunteer($executionId)
    {
        Volunteer::create([
            'surat_tugas_id' => $this->letterId,
            'pelaksanaan_id' => $executionId
        ]);

        $this->volunteers = Volunteer::where('surat_tugas_id', $this->letterId)->get();
        $this->executionVolunteers = Execution::where('surat_tugas_id', $this->letterId)->where('type', 'Volunteer')->get();
    }

    public function addVolunteerFromDropdown($executionId)
    {
        if (!$executionId) {
            return;
        }

        $this->addVolunteer($executionId);
        $this->selectedExecutionId = null;
    }

    public function deleteVolunteer($volunteerId)
    {
        $volunteer = Volunteer::findOrFail($volunteerId);
        $volunteer->delete();

        $this->volunteers = Volunteer::where('surat_tugas_id', $this->letterId)->get();
    }

    public function deleteExecution($executionId)
    {
        $execution = Execution::findOrFail($executionId);
        $execution->delete();

        $this->volunteers = Volunteer::where('surat_tugas_id', $this->letterId)->get();
        $this->executionVolunteers = Execution::where('surat_tugas_id', $this->letterId)->where('type', 'Volunteer')->get();
    }

    public function updateVolunteer($id, $field, $value)
    {
        $volunteer = Volunteer::findOrFail($id);

        if ($volunteer) {
            $volunteer->$field = $value;
            $volunteer->save();
        }
    }

    public function updateExecution($id, $field, $value)
    {
        $execution = Execution::findOrFail($id);

        if ($execution) {
            $execution->$field = $value;
            $execution->save();
        }
    }

    public function render()
    {
        return view('livewire.components.volunteer-table');
    }
}
