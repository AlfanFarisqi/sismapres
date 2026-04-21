<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $fillable = [
        'nama',
        'bobot',
        'jenis'
    ];

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
