<?php

namespace App\Livewire\Components;

use App\Models\Student;
use Livewire\Component;

class StudentTable extends Component
{
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
