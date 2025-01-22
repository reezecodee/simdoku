<?php

namespace App\Livewire\Document;

use App\Models\Proposal;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ModifyProposal extends Component
{
    #[Title('Modify Proposal Kegiatan')]

    public $judul, $tahun, $kata_pengantar, $penutup;

    public $id;
    public $proposal;

    public function mount($id)
    {
        $this->id = $id;
        $this->proposal = Proposal::findOrFail($id);
        $this->judul = $this->proposal->judul ?? '';
        $this->tahun = $this->proposal->tahun ?? '';
        $this->kata_pengantar = $this->proposal->kata_pengantar ?? '';
        $this->penutup = $this->proposal->penutup ?? '';
    }

    public function updated($property, $value)
    {
        $this->proposal->update([
            $property => $value
        ]);
    }

    public function render()
    {
        return view('livewire.document.modify-proposal');
    }
}
