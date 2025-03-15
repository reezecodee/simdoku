<?php

namespace App\Livewire\Document;

use App\Models\Report;
use App\Services\PDFReportService;
use App\Services\WordReportService;
use Livewire\Attributes\Title;
use Livewire\Component;

class ModifyReport extends Component
{
    #[Title('Modify Laporan Kegiatan')]

    public $id, $judul, $kutipan, $kata_pengantar, $penutup, $press_release;
    public $report;

    public function mount($id)
    {
        $this->id = $id;
        $this->report = Report::findOrFail($id);
        $this->judul = $this->report->judul;
        $this->kutipan = $this->report->kutipan;
        $this->kata_pengantar = $this->report->kata_pengantar;
        $this->penutup = $this->report->penutup;
        $this->press_release = $this->report->press_release;
    }

    public function updated($property)
    {
        $this->report->update([
            $property => $this->$property
        ]);
    }

    public function createPDFDocument()
    {
        return PDFReportService::print();
    }

    public function createWordDocument()
    {
        return WordReportService::print();
    }

    public function render()
    {
        return view('livewire.document.modify-report');
    }
}
