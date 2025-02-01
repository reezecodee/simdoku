<?php

namespace App\Livewire\Components;

use App\Models\ReportCommittee as ModelsReportCommittee;
use Livewire\Component;

class ReportCommittee extends Component
{
    public $id, $penasehat, $pembina, $penanggung_jawab, $ketua_pelaksana, $moderator, $publikasi_media, $sie_konsumsi, $sie_registrasi, $dokumentasi, $sosialisasi, $multimedia, $perlengkapan;
    public $reportCommittee;

    public function mount()
    {
        $this->reportCommittee = ModelsReportCommittee::where('laporan_id', $this->id)->first();
        $this->penasehat = $this->reportCommittee->penasehat;
        $this->pembina = $this->reportCommittee->pembina;
        $this->penanggung_jawab = $this->reportCommittee->penanggung_jawab;
        $this->ketua_pelaksana = $this->reportCommittee->ketua_pelaksana;
        $this->moderator = $this->reportCommittee->moderator;
        $this->publikasi_media = $this->reportCommittee->publikasi_media;
        $this->sie_konsumsi = $this->reportCommittee->sie_konsumsi;
        $this->sie_registrasi = $this->reportCommittee->sie_registrasi;
        $this->dokumentasi = $this->reportCommittee->dokumentasi;
        $this->sosialisasi = $this->reportCommittee->sosialisasi;
        $this->multimedia = $this->reportCommittee->multimedia;
        $this->perlengkapan = $this->reportCommittee->perlengkapan;
    }

    public function updated($property)
    {
        $this->reportCommittee->update([
            $property => $this->$property
        ]);
    }

    public function render()
    {
        return view('livewire.components.report-committee');
    }
}
