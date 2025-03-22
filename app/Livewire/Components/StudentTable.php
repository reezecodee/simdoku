<?php

namespace App\Livewire\Components;

use App\Exports\StudentsImport;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class StudentTable extends Component
{
    use WithFileUploads;

    public $excelFile;
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function createStudent()
    {
        Student::create([
            'beasiswa_id' => $this->id,
        ]);
    }

    public function updateStudent($id, $field, $value)
    {
        $student = Student::findOrFail($id);

        if ($student) {
            $student->$field = $value;
            $student->save();
        }
    }

    public function saveExcel()
    {
        $this->validate([
            'excelFile' => 'required|mimes:xlsx,csv',
        ]);
    
        $filePath = $this->excelFile->store('temp', 'public');
    
        Excel::import(new StudentsImport($this->id), Storage::disk('public')->path($filePath));
    
        Storage::disk('public')->delete($filePath);
        $this->reset('excelFile');
    
        session()->flash('success', 'Data berhasil diimpor!');
        return redirect()->to(route('scholarship.modify', $this->id));
    }

    public function cancleExcel()
    {
        $this->excelFile = null;
    }

    public function deleteStudent($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
    }

    public function render()
    {
        $students = Student::where('beasiswa_id', $this->id)->get();

        return view('livewire.components.student-table', compact('students'));
    }
}
