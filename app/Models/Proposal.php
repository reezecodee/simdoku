<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    public function signature()
    {
        return $this->belongsTo(Signature::class, 'ttd_ketua_panitia_id');
    }

    public function introduction()
    {
        return $this->hasOne(ProposalIntroduction::class, 'proposal_id');
    }

    public function planActivity()
    {
        return $this->hasOne(ProposalPlanActivity::class, 'proposal_id');
    }
}
