<?php

namespace App\Livewire\Components;

use App\Models\ReportEvaluation as ModelsReportEvaluation;
use Livewire\Component;

class ReportEvaluation extends Component
{
    public $id, $peserta_daftar, $peserta_hadir, $peserta_puas, $peserta_cukup_puas, $peserta_tidak_puas, $penilaian_sangat_bagus, $penilaian_cukup_bagus, $penilaian_kurang_bagus;
    public $reportEval;

    public function mount()
    {
        $this->reportEval = ModelsReportEvaluation::where('laporan_id', $this->id)->first();
        $this->peserta_daftar = $this->reportEval->peserta_daftar;
        $this->peserta_hadir = $this->reportEval->peserta_hadir;
        $this->peserta_puas = $this->reportEval->peserta_puas;
        $this->peserta_cukup_puas = $this->reportEval->peserta_cukup_puas;
        $this->peserta_tidak_puas = $this->reportEval->peserta_tidak_puas;
        $this->penilaian_sangat_bagus = $this->reportEval->penilaian_sangat_bagus;
        $this->penilaian_cukup_bagus = $this->reportEval->penilaian_cukup_bagus;
        $this->penilaian_kurang_bagus = $this->reportEval->penilaian_kurang_bagus;
    }

    public function updated($field)
    {
        $this->reportEval->update([
            $field => $this->$field
        ]);
    }

    public function render()
    {
        return view('livewire.components.report-evaluation');
    }
}
