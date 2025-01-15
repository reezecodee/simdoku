<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    public function letter()
    {
        return $this->hasMany(LetterAssignment::class, 'ttd_markom_id');
    }
}
