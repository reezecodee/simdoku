<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProposalIntroduction extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }
}
