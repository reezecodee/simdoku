<?php

namespace App\Livewire\Components;

use App\Models\ReportIntroduction;
use Livewire\Component;

class ReportIntro extends Component
{
    public $id, $latar_belakang, $tujuan_kegiatan, $manfaat_kegiatan, $indikator_keberhasilan;
    public $reportIntro;

    public function mount()
    {
        $this->reportIntro = ReportIntroduction::where('laporan_id', $this->id)->first();
        $this->latar_belakang = $this->reportIntro->latar_belakang;
        $this->tujuan_kegiatan = $this->reportIntro->tujuan_kegiatan;
        $this->manfaat_kegiatan = $this->reportIntro->manfaat_kegiatan;
        $this->indikator_keberhasilan = $this->reportIntro->indikator_keberhasilan;
    }

    public function updated($field)
    {
        $this->reportIntro->update([
            $field => $this->$field
        ]);
    }

    public function render()
    {
        return view('livewire.components.report-intro');
    }
}
