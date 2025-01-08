<?php

namespace App\Livewire\Components;

use App\Models\Execution;
use App\Models\LetterAssignment;
use App\Models\Staff;
use Livewire\Component;

class StaffTable extends Component
{
    public $executionStaffs;
    public $staffs;
    public $id;

    public $letterId;
    public $firstIdExecutionStaff;

    public function mount()
    {
        $this->executionStaffs = Execution::where('surat_tugas_id', $this->letterId)->where('type', 'Staff')->get();
        $this->staffs = Staff::where('surat_tugas_id', $this->letterId)->get();
    }

    public function addExecutionStaff($id, $type = 'Staff')
    {
        Execution::create([
            'surat_tugas_id' => $id,
            'type' => $type
        ]);

        $this->executionStaffs = Execution::where('surat_tugas_id', $id)->where('type', $type)->get();
    }

    public function addStaff($executionId)
    {
        Staff::create([
            'surat_tugas_id' => $this->letterId,
            'pelaksanaan_id' => $executionId
        ]);

        $this->staffs = Staff::where('surat_tugas_id', $this->letterId)->get();
    }

    public function addStaffFromDropdown($executionId)
    {
        if (!$executionId) {
            return;
        }

        $this->addStaff($executionId);
    }

    public function render()
    {
        return view('livewire.components.staff-table');
    }
}
