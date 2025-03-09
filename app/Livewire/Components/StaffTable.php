<?php

namespace App\Livewire\Components;

use App\Models\Execution;
use App\Models\Staff;
use Livewire\Component;

class StaffTable extends Component
{
    public $executionStaffs;
    public $staffs;
    public $id;

    public $letterId;
    public $firstIdExecutionStaff;
    public $selectedExecutionId;

    public function mount()
    {
        $this->selectedExecutionId = null;
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
        $this->executionStaffs = Execution::where('surat_tugas_id', $this->letterId)->where('type', 'Staff')->get();
    }

    public function addStaffFromDropdown($executionId)
    {
        if (!$executionId) {
            return;
        }

        $this->addStaff($executionId);
        $this->selectedExecutionId = null;
    }

    public function deleteStaff($staffId)
    {
        $staff = Staff::findOrFail($staffId);
        $staff->delete();

        $this->staffs = Staff::where('surat_tugas_id', $this->letterId)->get();
    }

    public function deleteExecution($executionId)
    {
        $execution = Execution::findOrFail($executionId);
        $execution->delete();

        $this->staffs = Staff::where('surat_tugas_id', $this->letterId)->get();
        $this->executionStaffs = Execution::where('surat_tugas_id', $this->letterId)->where('type', 'Staff')->get();
    }

    public function updateStaff($id, $field, $value)
    {
        $staff = Staff::findOrFail($id);

        if ($staff) {
            $staff->$field = $value;
            $staff->save();
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
        return view('livewire.components.staff-table');
    }
}
