<?php

namespace App\Livewire\Document;

use App\Models\Profile;
use App\Models\Proposal;
use App\Models\ProposalBudgetPlan;
use App\Models\ProposalPlanCommittee;
use App\Models\ProposalPlanSchedule;
use App\Services\PDFProposalService;
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
    public $budgets = [];

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
        $this->budgets = ProposalBudgetPlan::where('proposal_id', $id)->get();
    }

    public function updated($property)
    {
        $this->proposal->update([
            $property => $this->$property
        ]);
    }

    public function createWordDocument()
    {
        if (empty($this->proposal->judul)) {
            session()->flash('failed', 'Harap isi judul proposal terlebih dahulu');
            return redirect()->to(route('proposal.modify', $this->id));
        }

        if (empty($this->proposal->signature->tanda_tangan) || empty($this->my)) {
            session()->flash('failed', 'Harap upload atau pilih tanda tangan terlebih dahulu');
            return redirect()->to(route('proposal.modify', $this->id));
        }

        $signaturePath1 = storage_path('app/public/' . $this->proposal->signature->tanda_tangan);
        $signaturePath2 = storage_path('app/public/' . $this->my->tanda_tangan);

        if (!file_exists($signaturePath1) || !file_exists($signaturePath2)) {
            session()->flash('failed', 'Harap upload atau pilih tanda tangan terlebih dahulu');
            return redirect()->to(route('proposal.modify', $this->id));
        }

        return WordProposalService::print(
            $this->proposal,
            $this->my,
            $this->date,
            $this->planSchedules,
            $this->committees,
            $this->budgets
        );
    }

    public function createPDFDocument()
    {
        if (empty($this->proposal->judul)) {
            session()->flash('failed', 'Harap isi judul proposal terlebih dahulu');
            return redirect()->to(route('proposal.modify', $this->id));
        }

        if (empty($this->proposal->signature->tanda_tangan) || empty($this->my)) {
            session()->flash('failed', 'Harap upload atau pilih tanda tangan terlebih dahulu');
            return redirect()->to(route('proposal.modify', $this->id));
        }

        $signaturePath1 = storage_path('app/public/' . $this->proposal->signature->tanda_tangan);
        $signaturePath2 = storage_path('app/public/' . $this->my->tanda_tangan);

        if (!file_exists($signaturePath1) || !file_exists($signaturePath2)) {
            session()->flash('failed', 'Harap upload atau pilih tanda tangan terlebih dahulu');
            return redirect()->to(route('proposal.modify', $this->id));
        }

        return PDFProposalService::print(
            $this->proposal,
            $this->date,
            $this->planSchedules,
            $this->committees,
            $this->budgets,
        );
    }

    public function render()
    {
        return view('livewire.document.modify-proposal');
    }
}
