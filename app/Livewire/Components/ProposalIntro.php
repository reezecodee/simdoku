<?php

namespace App\Livewire\Components;

use App\Models\ProposalIntroduction;
use Livewire\Component;

class ProposalIntro extends Component
{
    public $id;
    public $proposalIntro;
    public $latar_belakang, $tujuan_kegiatan, $indikator_keberhasilan;

    public function mount()
    {
        $this->proposalIntro = ProposalIntroduction::where('proposal_id', $this->id)->first();
        $this->latar_belakang = $this->proposalIntro->latar_belakang ?? '';
        $this->tujuan_kegiatan = $this->proposalIntro->tujuan_kegiatan ?? '';
        $this->indikator_keberhasilan = $this->proposalIntro->indikator_keberhasilan ?? '';
    }

    public function updated($property, $value)
    {
        $this->proposalIntro->update([
            $property => $value
        ]);
    }

    public function render()
    {
        return view('livewire.components.proposal-intro');
    }
}
