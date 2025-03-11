<?php

namespace App\Livewire\Document;

use App\Models\Proposal;
use App\Services\WordProposalService;
use Carbon\Carbon;

use Livewire\Attributes\Title;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;

class ModifyProposal extends Component
{
    #[Title('Modify Proposal Kegiatan')]

    public $judul, $tahun, $kata_pengantar, $penutup;

    public $id;
    public $proposal;
    public $date;

    public function mount($id)
    {
        $this->id = $id;
        $this->proposal = Proposal::findOrFail($id);
        $this->judul = $this->proposal->judul ?? '';
        $this->tahun = $this->proposal->tahun ?? '';
        $this->kata_pengantar = $this->proposal->kata_pengantar ?? '';
        $this->penutup = $this->proposal->penutup ?? '';
        $this->date = Carbon::now()->translatedFormat('d F Y');
    }

    public function updated($property)
    {
        $this->proposal->update([
            $property => $this->$property
        ]);
    }

    public function createWordDocument()
    {
        return WordProposalService::print();
    }

    public function generatePDF() {}

    public function render()
    {
        return view('livewire.document.modify-proposal');
    }
}
