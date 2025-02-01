<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    public function signature()
    {
        return $this->belongsTo(Signature::class, 'ttd_ketua_pelaksana');
    }

    public function signature2()
    {
        return $this->belongsTo(Signature::class, 'ttd_kadiv_dmer');
    }
}
