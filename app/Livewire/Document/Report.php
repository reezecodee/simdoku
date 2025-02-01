<?php

namespace App\Livewire\Document;

use App\Models\Report as ModelsReport;
use App\Models\ReportEvaluation;
use App\Models\ReportIntroduction;
use App\Models\ReportPlanActivity;
use Livewire\Attributes\Title;
use Livewire\Component;

class Report extends Component
{
    #[Title('Report Kegiatan')]

    public function createReport()
    {
        $report = ModelsReport::create([]);

        ReportIntroduction::create([
            'laporan_id' => $report->id
        ]);

        ReportPlanActivity::create([
            'laporan_id' => $report->id
        ]);

        ReportEvaluation::create([
            'laporan_id' => $report->id
        ]);

        $this->redirect(route('report.modify', $report->id));
    }

    public function render()
    {
        return view('livewire.document.report');
    }
}
