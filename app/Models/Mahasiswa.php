<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'npm',
        'tingkat',
        'email',
        'no_hp',
        'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }

    public function hasilSeleksi()
    {
        return $this->hasOne(HasilSeleksi::class);
    }
}
