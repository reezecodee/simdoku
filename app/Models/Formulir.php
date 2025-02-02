<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    public function signature()
    {
        return $this->belongsTo(Signature::class, 'ttd_ka_devisi_mer');
    }

    public function signature2()
    {
        return $this->belongsTo(Signature::class, 'ttd_ka_baku');
    }
}
