<?php

namespace App\Livewire\Letter;

use App\Models\Execution;
use App\Models\LetterAssignment;
use App\Models\Profile;
use App\Models\Staff;
use App\Models\Volunteer;
use App\Services\PDFLetterService;
use App\Services\WordLetterService;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

class ModifyAssignment extends Component
{
    #[Title('Buat Surat Tugas')]

    public $date;
    public $id;
    public $letter;
    public $path;
    public $my;

    public $firstIdExecutionStaff;
    public $firstIdExecutionVolunteer;

    public $executionStaffs;
    public $staffs;
    public $executionVolunteers;
    public $volunteers;

    public function mount($id)
    {
        $this->date = Carbon::now()->translatedFormat('d F Y');
        $this->id = $id;
        $this->letter = LetterAssignment::with('signature')->findOrFail($id);
        $this->path = storage_path('app/public/' . $this->letter->signature->tanda_tangan);
        $this->my = Profile::first();

        $this->firstIdExecutionStaff = Execution::where('surat_tugas_id', $id)->where('type', 'Staff')->first();
        $this->firstIdExecutionVolunteer = Execution::where('surat_tugas_id', $id)->where('type', 'Volunteer')->first();

        $this->executionStaffs = Execution::where('surat_tugas_id', $id)->where('type', 'Staff')->get();
        $this->staffs = Staff::where('surat_tugas_id', $id)->get();
        $this->executionVolunteers = Execution::where('surat_tugas_id', $id)->where('type', 'Volunteer')->get();
        $this->volunteers = Volunteer::where('surat_tugas_id', $id)->get();
    }

    public function printPDF()
    {
        return PDFLetterService::print(
            $this->date,
            $this->letter,
            $this->executionStaffs,
            $this->staffs,
            $this->executionVolunteers,
            $this->volunteers
        );
    }

    public function printWord()
    {
        return WordLetterService::print(
            $this->date,
            $this->letter,
            $this->executionStaffs,
            $this->executionVolunteers,
            $this->my
        );
    }

    public function render()
    {
        return view('livewire.letter.modify-assignment');
    }
}
