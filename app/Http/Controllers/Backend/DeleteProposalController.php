<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;

class DeleteProposalController extends Controller
{
    public function deleteProposal($id)
    {
        $letter = Proposal::findOrFail($id);
        $letter->delete();

        session()->flash('success', 'Berhasil menghapus proposal kegiatan.');
        return redirect()->to(route('proposal.index'));
    }
}
