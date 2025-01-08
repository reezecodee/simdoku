<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\Models\LetterAssignment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LetterDatatableController extends Controller
{
    public function getLetters()
    {
        $letters = LetterAssignment::query();
        
        return DataTables::of($letters)
        ->addIndexColumn()
        ->addColumn('perihal', function($row){
            return $row->perihal ?? 'Surat tak berperihal';
        })
        ->addColumn('nama_acara', function($row){
            return $row->nama_acara ?? 'Tidak diketahui';
        })
        ->addColumn('action', function ($row) {
            return '
            <a wire:navigate href="'. route('letter.modify', $row->id) .'" style="text-decoration: none;">
            <button class="btn btn-primary btn-sm">Edit</button>
            </a>
            <button class="btn btn-danger btn-sm">Hapus</button>
            ';
        }) 
        ->rawColumns(['action']) 
        ->make(true); 
    }
}
