<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use App\Models\Student;
use Illuminate\Http\Request;

class DeleteSholarshipController extends Controller
{
    public function deleteScholarship($id)
    {
        $scholarship = Scholarship::findOrFail($id);
        $scholarship->delete();

        session()->flash('success', 'Berhasil menghapus beasiswa.');
        return redirect()->to(route('scholarship.index'));
    }

    public function deleteAllStudents($id)
    {
        Student::where('beasiswa_id', $id)->delete();

        session()->flash('success', 'Berhasil menghapus seluruh siswa penerima beasiswa.');
        return redirect()->to(route('scholarship.modify', $id));
    }
}
