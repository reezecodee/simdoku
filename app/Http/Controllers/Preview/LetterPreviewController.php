<?php

namespace App\Http\Controllers\Preview;

use App\Http\Controllers\Controller;
use App\Livewire\Profile\Profile;
use App\Models\Execution;
use App\Models\LetterAssignment;
use App\Models\Staff;
use App\Models\Volunteer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LetterPreviewController extends Controller
{
    public function preview($id)
    {
        $today = Carbon::now()->translatedFormat('d F Y');
        $letter = LetterAssignment::with('signature')->findOrFail($id);
        $imgbase64 = $this->generateBase64($letter->signature->tanda_tangan);
        $executionStaffs = Execution::where('surat_tugas_id', $id)->where('type', 'Staff')->get();
        $staffs = Staff::where('surat_tugas_id', $id)->get();
        $executionVolunteers = Execution::where('surat_tugas_id', $id)->where('type', 'Volunteer')->get();
        $volunteers = Volunteer::where('surat_tugas_id', $id)->get();

        return view('preview.surat-tugas', compact('today', 'letter', 'executionStaffs', 'staffs', 'executionVolunteers', 'volunteers', 'imgbase64'));
    }

    private function generateBase64($path)
    {
        $storagePath = storage_path('app/public/' . $path);
        $imageData = base64_encode(file_get_contents($storagePath));
        $result = 'data:image/' . pathinfo($storagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;

        return $result;
    }
}
