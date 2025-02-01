<?php

namespace App\Livewire\Components;

use App\Models\ReportBudgetRealization as ModelsReportBudgetRealization;
use Livewire\Component;

class ReportBudgetRealization extends Component
{
    public $id;

    public function createBudget()
    {
        ModelsReportBudgetRealization::create([
            'laporan_id' => $this->id
        ]);
    }

    public function updateBudget($id, $field, $value)
    {
        $budget = ModelsReportBudgetRealization::findOrFail($id);

        if ($budget) {
            $budget->$field = $value;
            $budget->save();
        }
    }

    public function deleteBudget($id)
    {
        $budget = ModelsReportBudgetRealization::findOrFail($id);
        $budget->delete();
    }

    public function render()
    {
        $budgets = ModelsReportBudgetRealization::where('laporan_id', $this->id)->get();

        return view('livewire.components.report-budget-realization', compact('budgets'));
    }
}
