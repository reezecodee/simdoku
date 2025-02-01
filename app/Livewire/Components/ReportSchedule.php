<?php

namespace App\Livewire\Components;

use App\Models\ReportSchedule as ModelsReportSchedule;
use Livewire\Component;

class ReportSchedule extends Component
{
    public $id;

    public function createSchedule()
    {
        ModelsReportSchedule::create([
            'laporan_id' => $this->id
        ]);
    }

    public function updateSchedule($id, $field, $value)
    {
        $schedule = ModelsReportSchedule::findOrFail($id);

        if ($schedule) {
            $schedule->$field = $value;
            $schedule->save();
        }
    }

    public function deleteSchedule($id)
    {
        $schedule = ModelsReportSchedule::findOrFail($id);
        $schedule->delete();
    }

    public function render()
    {
        $schedules = ModelsReportSchedule::where('laporan_id', $this->id)->get();

        return view('livewire.components.report-schedule', compact('schedules'));
    }
}
