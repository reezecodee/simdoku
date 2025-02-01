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
}
