<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Formulir;
use Illuminate\Http\Request;

class DeleteFormulirController extends Controller
{
    public function deleteFormulir($id)
    {
        $letter = Formulir::findOrFail($id);
        $letter->delete();

        session()->flash('success', 'Berhasil menghapus formulir pengajuan dana.');
        return redirect()->to(route('form.index'));
    }
}
