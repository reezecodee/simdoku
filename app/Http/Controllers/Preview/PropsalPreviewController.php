<?php

namespace App\Http\Controllers\Preview;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Proposal;
use App\Models\ProposalBudgetPlan;
use App\Models\ProposalPlanCommittee;
use App\Models\ProposalPlanSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PropsalPreviewController extends Controller
{
    public function preview($id)
    {
        $proposal = Proposal::with(
            'introduction',
            'planActivity'
        )->findOrFail($id);
        $planSchedules = ProposalPlanSchedule::where('proposal_id', $id)->get();
        $committees = ProposalPlanCommittee::where('proposal_id', $id)->get();
        $budgets = ProposalBudgetPlan::where('proposal_id', $id)->get();
        $date = Carbon::now()->translatedFormat('d F Y');
        $my = Profile::first();
        $imgbase64 = generateBase64($proposal->signature->tanda_tangan);

        if (empty($proposal->judul)) {
            session()->flash('failed', 'Harap isi judul proposal terlebih dahulu');
            return redirect()->to(route('proposal.modify', $id));
        }

        if (empty($proposal->signature->tanda_tangan) || empty($my)) {
            session()->flash('failed', 'Harap upload atau pilih tanda tangan terlebih dahulu');
            return redirect()->to(route('proposal.modify', $id));
        }

        $signaturePath1 = storage_path('app/public/' . $proposal->signature->tanda_tangan);
        $signaturePath2 = storage_path('app/public/' . $my->tanda_tangan);

        if (!file_exists($signaturePath1) || !file_exists($signaturePath2)) {
            session()->flash('failed', 'Harap upload atau pilih tanda tangan terlebih dahulu');
            return redirect()->to(route('proposal.modify', $id));
        }

        return view('preview.proposal', compact('proposal', 'date', 'planSchedules', 'committees', 'budgets', 'imgbase64'));
    }
}
