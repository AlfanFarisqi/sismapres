<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilSeleksi extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'total_skor',
        'ranking',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
