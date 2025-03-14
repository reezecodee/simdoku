<?php

namespace App\Http\Controllers\Preview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportPreviewController extends Controller
{
    public function preview($id)
    {
        return view('preview.laporan');
    }
}
