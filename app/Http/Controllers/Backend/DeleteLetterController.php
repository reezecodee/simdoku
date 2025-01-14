<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LetterAssignment;
use Illuminate\Http\Request;

class DeleteLetterController extends Controller
{
    public function deleteLetter($id)
    {
        $letter = LetterAssignment::findOrFail($id);
        $letter->delete();

        session()->flash('success', 'Berhasil menghapus surat tugas.');
        return redirect()->to(route('letter.index'));
    }
}
