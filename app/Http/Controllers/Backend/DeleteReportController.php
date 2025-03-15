<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class DeleteReportController extends Controller
{
    public function deleteReport($id)
    {
        $letter = Report::findOrFail($id);
        $letter->delete();

        session()->flash('success', 'Berhasil menghapus laporan kegiatan.');
        return redirect()->to(route('report.index'));
    }
}
