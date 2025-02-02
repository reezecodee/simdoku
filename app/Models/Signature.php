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
    
    public function proposal()
    {
        return $this->hasMany(Proposal::class, 'ttd_ketua_panitia_id');
    }

    public function report()
    {
        return $this->hasMany(Report::class, 'ttd_ketua_pelaksana');
    }

    public function report2()
    {
        return $this->hasMany(Report::class, 'ttd_kadiv_dmer');
    }
    
    public function formulir()
    {
        return $this->hasMany(Formulir::class, 'ttd_ka_devisi_mer');
    }

    public function formulir2()
    {
        return $this->hasMany(Formulir::class, 'ttd_ka_baku');
    }
}
