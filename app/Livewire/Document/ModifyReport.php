<?php

namespace App\Livewire\Document;

use App\Models\Profile;
use App\Models\Report;
use App\Models\ReportBudgetRealization;
use App\Models\ReportCommittee;
use App\Models\ReportEvaluation;
use App\Models\ReportFile;
use App\Models\ReportIntroduction;
use App\Models\ReportPlanActivity;
use App\Models\ReportSchedule;
use App\Services\PDFReportService;
use App\Services\WordReportService;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Title;
use Livewire\Component;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class ModifyReport extends Component
{
    #[Title('Modify Laporan Kegiatan')]

    public $id, $judul, $kutipan, $kata_pengantar, $penutup, $press_release, $date;
    public $report, $introduction, $planActivities, $schedules, $budgetRealizations, $committee, $evaluation, $documentations, $attendances, $receipts, $my;

    public function mount($id)
    {
        $this->id = $id;
        $this->report = Report::findOrFail($id);
        $this->judul = $this->report->judul;
        $this->kutipan = $this->report->kutipan;
        $this->kata_pengantar = $this->report->kata_pengantar;
        $this->penutup = $this->report->penutup;
        $this->press_release = $this->report->press_release;
        $this->date = Carbon::now()->translatedFormat('d F Y');

        $this->introduction = ReportIntroduction::where('laporan_id', $id)->first();
        $this->planActivities = ReportPlanActivity::where('laporan_id', $id)->first();
        $this->schedules = ReportSchedule::where('laporan_id', $id)->get();
        $this->budgetRealizations = ReportBudgetRealization::where('laporan_id', $id)->get();
        $this->committee = ReportCommittee::where('laporan_id', $id)->first();
        $this->evaluation = ReportEvaluation::where('laporan_id', $id)->first();
        $this->documentations = ReportFile::where('laporan_id', $id)->where('type', 'documentation')->get();
        $this->attendances = ReportFile::where('laporan_id', $id)->where('type', 'attendance')->get();
        $this->receipts = ReportFile::where('laporan_id', $id)->where('type', 'receipt')->get();
        $this->my = Profile::first();
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
        return WordReportService::print(
            $this->report,
            $this->introduction,
            $this->planActivities,
            $this->schedules,
            $this->budgetRealizations,
            $this->committee,
            $this->evaluation,
            $this->documentations,
            $this->attendances,
            $this->receipts,
            $this->my,
            $this->date,
        );
    }

    public function render()
    {
        return view('livewire.document.modify-report');
    }
}
