<?php

namespace App\Livewire\Components;

use App\Models\ReportPlanActivity as ModelsReportPlanActivity;
use Livewire\Component;

class ReportPlanActivity extends Component
{
    public $id, $tema_kegiatan, $deskripsi_kegiatan, $penyelenggara_kegiatan, $pemateri_narasumber, $peserta_kegiatan, $waktu_pelaksanaan;
    public $reportPlan;

    public function mount()
    {
        $this->reportPlan = ModelsReportPlanActivity::where('laporan_id', $this->id)->first();
        $this->tema_kegiatan = $this->reportPlan->tema_kegiatan;
        $this->deskripsi_kegiatan = $this->reportPlan->deskripsi_kegiatan;
        $this->penyelenggara_kegiatan = $this->reportPlan->penyelenggara_kegiatan;
        $this->pemateri_narasumber = $this->reportPlan->pemateri_narasumber;
        $this->peserta_kegiatan = $this->reportPlan->peserta_kegiatan;
        $this->waktu_pelaksanaan = $this->reportPlan->waktu_pelaksanaan;
    }

    public function updated($field)
    {
        $this->reportPlan->update([
            $field => $this->$field
        ]);
    }

    public function render()
    {
        return view('livewire.components.report-plan-activity');
    }
}
