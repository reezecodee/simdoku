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
use Livewire\Attributes\Title;
use Livewire\Component;

class ModifyReport extends Component
{
    #[Title('Modify Laporan Kegiatan')]

    public $id, $judul, $kutipan, $kata_pengantar, $penutup, $press_release, $date;
    public $report, $introduction, $planActivity, $schedules, $budgetRealizations, $committee, $evaluation, $documentations, $attendances, $receipts, $my;

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
        $this->planActivity = ReportPlanActivity::where('laporan_id', $id)->first();
        $this->schedules = ReportSchedule::where('laporan_id', $id)->get();
        $this->budgetRealizations = ReportBudgetRealization::where('laporan_id', $id)->get();
        $this->committee = ReportCommittee::where('laporan_id', $id)->first();
        $this->evaluation = ReportEvaluation::where('laporan_id', $id)->first();
        $this->documentations = ReportFile::where('laporan_id', $id)->where('type', 'documentation')->get();
        $this->attendances = ReportFile::where('laporan_id', $id)->where('type', 'attendance')->get();
        $this->receipts = ReportFile::where('laporan_id', $id)->where('type', 'receipt')->get();
        $this->my = Profile::first();
    }

    protected function check()
    {
        if (empty($this->report->judul)) {
            session()->flash('failed', 'Harap isi judul laporan terlebih dahulu');
            return redirect()->to(route('report.modify', $this->id));
        }

        if (empty($this->report->signature->tanda_tangan) || empty($this->my) || empty($this->report->signature2->tanda_tangan)) {
            session()->flash('failed', 'Harap upload atau pilih tanda tangan terlebih dahulu');
            return redirect()->to(route('report.modify', $this->id));
        }

        $signaturePath1 = storage_path('app/public/' . $this->report->signature->tanda_tangan);
        $signaturePath2 = storage_path('app/public/' . $this->report->signature2->tanda_tangan);
        $signaturePath3 = storage_path('app/public/' . $this->my->tanda_tangan);

        if (!file_exists($signaturePath1) || !file_exists($signaturePath2) || !file_exists($signaturePath3)) {
            session()->flash('failed', 'Harap upload atau pilih tanda tangan terlebih dahulu');
            return redirect()->to(route('report.modify', $this->id));
        }

        return null;
    }

    public function updated($property)
    {
        $this->report->update([
            $property => $this->$property
        ]);
    }

    public function previewReport()
    {
        $check = $this->check();

        if ($check) return $check;

        try {
            PDFReportService::generatePieChart($this->evaluation);
            return redirect()->to(route('report.preview', $this->report->id));
        } catch (\Throwable $e) {
            session()->flash('failed', 'Pastikan data evaluasi kegiatan sudah di isi dengan benar.');
            return redirect()->to(route('report.modify', $this->id));
        }
    }

    public function createPDFDocument()
    {
        $check = $this->check();

        if ($check) return $check;

        try {
            return PDFReportService::print(
                $this->report,
                $this->introduction,
                $this->planActivity,
                $this->schedules,
                $this->budgetRealizations,
                $this->committee,
                $this->evaluation,
                $this->documentations,
                $this->attendances,
                $this->receipts,
                $this->date,
            );
        } catch (\Throwable $e) {
            session()->flash('failed', 'Pastikan data evaluasi kegiatan sudah di isi dengan benar.');
            return redirect()->to(route('report.modify', $this->id));
        }
    }

    public function createWordDocument()
    {
        $check = $this->check();

        if ($check) return $check;

        try {
            return WordReportService::print(
                $this->report,
                $this->introduction,
                $this->planActivity,
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
        } catch (\Throwable $e) {
            session()->flash('failed', 'Pastikan data evaluasi kegiatan sudah di isi dengan benar.');
            return redirect()->to(route('report.modify', $this->id));
        }
    }

    public function render()
    {
        return view('livewire.document.modify-report');
    }
}
