<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'nama_berkas',
        'file_path',
    ];
}
