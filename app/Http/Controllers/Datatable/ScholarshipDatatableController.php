<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ScholarshipDatatableController extends Controller
{
    public function getScholarships()
    {
        $scholarships = Scholarship::orderBy('created_at', 'desc')->get();

        return DataTables::of($scholarships)
        ->addIndexColumn()
        ->addColumn('nama', function($row){
            return $row->nama ?? 'Nama beasiswa tidak diketahui';
        })
        ->addColumn('periode', function($row){
            return $row->periode ?? 'Periode tidak diketahui';
        })
        ->addColumn('tahun', function($row){
            return $row->tahun ?? 'Tahun tidak diketahui';
        })
        ->addColumn('action', function($row){
            return '
            <div class="d-flex">
            <a wire:navigate class="mr-2 d-inline-block" href="'. route('scholarship.modify', $row->id) .'" style="text-decoration: none;">
            <button class="btn btn-primary btn-sm">Edit</button>
            </a>
            <form action="'. route('scholarship.delete', $row->id) .'" method="POST" id="'. $row->id .'">
            '. csrf_field() .'
            '. method_field('DELETE') .'
            <button class="btn btn-danger btn-sm" onclick="submitForm(\'' . $row->id . '\')" type="button">Hapus</button>
            </form>
            </div>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
