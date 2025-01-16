<?php

namespace App\Livewire\Form;

use App\Exports\FormulirExport;
use App\Models\BudgetSubmission;
use App\Models\Formulir;
use Illuminate\Support\Facades\Config;
use Livewire\Attributes\Title;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Riskihajar\Terbilang\Facades\Terbilang;

class ModifyFormulir extends Component
{
    #[Title('Modify Formulir Kegiatan')]

    public $id;
    public $form;

    public $judul, $tgl_pengajuan, $pemohon, $unit_kerja, $no_rekening, $atas_nama, $tgl_diperlukan;

    public function mount($id)
    {
        $this->id = $id;
        $this->form = Formulir::findOrFail($id);

        $this->judul = $this->form->judul;
        $this->tgl_pengajuan = $this->form->tgl_pengajuan;
        $this->pemohon = $this->form->pemohon;
        $this->unit_kerja = $this->form->unit_kerja;
        $this->no_rekening = $this->form->no_rekening;
        $this->atas_nama = $this->form->atas_nama;
        $this->tgl_diperlukan = $this->form->tgl_diperlukan;
    }

    public function updated($field, $value)
    {
        $this->form->update([
            $field => $value
        ]);
    }

    public function addBudget()
    {
        BudgetSubmission::create([
            'formulir_id' => $this->id
        ]);
    }

    public function deleteBudget($id)
    {
        $budget = BudgetSubmission::findOrFail($id);
        $budget->delete();
    }

    public function updateBudget($id, $field, $value)
    {
        $budget = BudgetSubmission::findOrFail($id);

        if ($budget) {
            $budget->$field = $value;
            $budget->save();
        }
    }

    public function exportExcel()
    {
        return Excel::download(new FormulirExport($this->id), 'pengajuan_dana.xlsx');
    }

    public function render()
    {
        Config::set('terbilang.locale', 'id');

        $budgets = BudgetSubmission::where('formulir_id', $this->id)->get();
        $total = BudgetSubmission::where('formulir_id', $this->id)->sum('jumlah');
        $terbilang = ucwords(Terbilang::make($total));

        return view('livewire.form.modify-formulir', compact('budgets', 'total', 'terbilang'));
    }
}
