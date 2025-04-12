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

    public $id, $today, $letter, $my;
    public $firstIdExecutionStaff, $firstIdExecutionVolunteer;
    public $executionStaffs, $staffs, $executionVolunteers, $volunteers;

    public function mount($id)
    {
        $this->id = $id;
        $this->today = Carbon::now()->translatedFormat('d F Y');
        $this->letter = LetterAssignment::with('signature')->findOrFail($id);
        $this->my = Profile::first();

        $this->firstIdExecutionStaff = Execution::where('surat_tugas_id', $id)->where('type', 'Staff')->first();
        $this->firstIdExecutionVolunteer = Execution::where('surat_tugas_id', $id)->where('type', 'Volunteer')->first();

        $this->executionStaffs = Execution::where('surat_tugas_id', $id)->where('type', 'Staff')->get();
        $this->staffs = Staff::where('surat_tugas_id', $id)->get();
        $this->executionVolunteers = Execution::where('surat_tugas_id', $id)->where('type', 'Volunteer')->get();
        $this->volunteers = Volunteer::where('surat_tugas_id', $id)->get();
    }

    public function previewLetter()
    {
        return redirect()->to(route('letter.preview', $this->id));
    }

    public function printPDF()
    {
        try {
            return PDFLetterService::print(
                $this->today,
                $this->letter,
                $this->executionStaffs,
                $this->staffs,
                $this->executionVolunteers,
                $this->volunteers
            );
        } catch (\Throwable $e) {
            session()->flash('failed', 'Terjadi kesalahan saat mencoba mengexpor PDF.');
            return redirect()->to(route('letter.modify', $this->id));
        }
    }

    public function printWord()
    {
        try {
            return WordLetterService::print(
                $this->today,
                $this->letter,
                $this->executionStaffs,
                $this->executionVolunteers,
                $this->my
            );
        } catch (\Throwable $e) {
            session()->flash('failed', 'Terjadi kesalahan saat mencoba mengexpor Word.');
            return redirect()->to(route('letter.modify', $this->id));
        }
    }

    public function render()
    {
        return view('livewire.letter.modify-assignment');
    }
}
