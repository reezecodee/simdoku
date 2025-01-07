<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class LetterAssignment extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    public function staff()
    {
        return $this->hasMany(Staff::class, 'surat_tugas_id');
    }

    public function execution()
    {
        return $this->hasMany(Execution::class, 'surat_tugas_id');
    }
}
