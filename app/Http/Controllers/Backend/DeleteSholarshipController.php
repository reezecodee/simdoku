<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
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
}
