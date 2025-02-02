<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\Models\Formulir;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FundApplicationDatatableController extends Controller
{
    public function getFormulirs()
    {
        $funds = Formulir::orderBy('created_at', 'desc')->get();

        return DataTables::of($funds)
        ->addIndexColumn()
        ->addColumn('judul', function($row){
            return $row->judul ?? 'Judul tidak diketahui';
        })
        ->addColumn('tgl_pengajuan', function($row){
            return $row->tgl_pengajuan ?? 'Belum diatur';
        })
        ->addColumn('tgl_diperlukan', function($row){
            return $row->tgl_diperlukan ?? 'Belum diatur';
        })
        ->addColumn('action', function($row){
            return '
            <div class="d-flex">
            <a wire:navigate class="mr-2 d-inline-block" href="'. route('form.modify', $row->id) .'" style="text-decoration: none;">
            <button class="btn btn-primary btn-sm">Edit</button>
            </a>
            <form action="'. route('form.delete', $row->id) .'" method="POST" id="'. $row->id .'">
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
