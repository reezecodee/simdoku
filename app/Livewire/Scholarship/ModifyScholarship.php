<?php

namespace App\Livewire\Scholarship;

use App\Models\Scholarship;
use Livewire\Attributes\Title;
use Livewire\Component;

class ModifyScholarship extends Component
{
    #[Title('Buat Penerima Beasiswa')]

    public $id;
    public $scholarship, $nama, $periode, $tahun;

    public function mount($id)
    {
        $this->id = $id;

        $this->scholarship = Scholarship::findOrFail($id);

        $this->nama = $this->scholarship->nama;
        $this->periode = $this->scholarship->periode;
        $this->tahun = $this->scholarship->tahun;
    }

    public function updated($property)
    {
        $this->scholarship->update([
            $property => $this->$property
        ]);
    }

    public function render()
    {
        return view('livewire.scholarship.modify-scholarship');
    }
}
