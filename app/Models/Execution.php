<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Execution extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    public function letter()
    {
        return $this->belongsTo(LetterAssignment::class, 'surat_tugas_id');
    }
}
