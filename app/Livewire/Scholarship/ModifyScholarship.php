<?php

namespace App\Livewire\Scholarship;

use App\Exports\StudentsExport;
use App\Models\Scholarship;
use Livewire\Attributes\Title;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

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

    public function downloadExcel()
    {
        $title = $this->nama ?? 'Beasiswa Tak Berjudul';
        return Excel::download(new StudentsExport($this->id), "{$title}.xlsx");
    }

    public function render()
    {
        return view('livewire.scholarship.modify-scholarship');
    }
}
