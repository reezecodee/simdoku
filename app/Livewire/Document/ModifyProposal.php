<?php

namespace App\Livewire\Document;

use App\Models\Profile;
use App\Models\Proposal;
use App\Models\ProposalPlanCommittee;
use App\Models\ProposalPlanSchedule;
use App\Services\WordProposalService;
use Carbon\Carbon;

use Livewire\Attributes\Title;
use Livewire\Component;

class ModifyProposal extends Component
{
    #[Title('Modify Proposal Kegiatan')]

    public $judul, $tahun, $kata_pengantar, $penutup;

    public $id;
    public $proposal;
    public $date;
    public $my;
    public $planSchedules = [];
    public $committees = [];

    public function mount($id)
    {
        $this->id = $id;
        $this->proposal = Proposal::with(
            'introduction',
            'planActivity'
        )->findOrFail($id);
        $this->judul = $this->proposal->judul ?? '';
        $this->tahun = $this->proposal->tahun ?? '';
        $this->kata_pengantar = $this->proposal->kata_pengantar ?? '';
        $this->penutup = $this->proposal->penutup ?? '';
        $this->date = Carbon::now()->translatedFormat('d F Y');
        $this->my = Profile::first();
        $this->planSchedules = ProposalPlanSchedule::where('proposal_id', $id)->get();
        $this->committees = ProposalPlanCommittee::where('proposal_id', $id)->get();
    }

    public function updated($property)
    {
        $this->proposal->update([
            $property => $this->$property
        ]);
    }

    public function createWordDocument()
    {
        return WordProposalService::print(
            $this->proposal, 
            $this->my, 
            $this->date, 
            $this->planSchedules,
            $this->committees
        );
    }

    public function generatePDF() {}

    public function render()
    {
        return view('livewire.document.modify-proposal');
    }
}
