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

    public function mount()
    {
        $this->executionVolunteers = Execution::where('surat_tugas_id', $this->letterId)->where('type', 'Volunteer')->get();
        $this->volunteers = Volunteer::where('surat_tugas_id', $this->letterId)->get();
    }

    public function addExecutionVolunteer($id, $type = 'Volunteer')
    {
        dd('test');
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
    }

    public function addVolunteerFromDropdown($executionId)
    {
        if (!$executionId) {
            return;
        }

        $this->addVolunteer($executionId);
    }

    public function render()
    {
        return view('livewire.components.volunteer-table');
    }
}
