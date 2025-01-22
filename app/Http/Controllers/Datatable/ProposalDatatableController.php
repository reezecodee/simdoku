<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProposalDatatableController extends Controller
{
    public function getProposals()
    {
        $proposals = Proposal::orderBy('created_at', 'desc')->get();

        return DataTables::of($proposals)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            return '
            <div class="d-flex">
            <a wire:navigate class="mr-2 d-inline-block" href="'. route('proposal.modify', $row->id) .'" style="text-decoration: none;">
            <button class="btn btn-primary btn-sm">Edit</button>
            </a>
            <form action="'. route('proposal.delete', $row->id) .'" method="POST" id="'. $row->id .'">
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
