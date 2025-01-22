<?php

namespace App\Livewire\Components;

use App\Models\ProposalPlanActivity;
use Livewire\Component;

class ProposalPlan extends Component
{
    public $id;
    public $proposalPlan;
    public $tema_kegiatan, $deskripsi_kegiatan, $penyelenggara_kegiatan, $peserta_kegiatan, $waktu_pelaksanaan;

    public function mount()
    {
        $this->proposalPlan = ProposalPlanActivity::where('proposal_id', $this->id)->first();
        $this->tema_kegiatan = $this->proposalPlan->tema_kegiatan ?? '';
        $this->deskripsi_kegiatan = $this->proposalPlan->deskripsi_kegiatan ?? '';
        $this->penyelenggara_kegiatan = $this->proposalPlan->penyelenggara_kegiatan ?? '';
        $this->peserta_kegiatan = $this->proposalPlan->peserta_kegiatan ?? '';
        $this->waktu_pelaksanaan = $this->proposalPlan->waktu_pelaksanaan ?? '';
    }

    public function updated($property, $value)
    {
        $this->proposalPlan->update([
            $property => $value
        ]);
    }

    public function render()
    {
        return view('livewire.components.proposal-plan');
    }
}
