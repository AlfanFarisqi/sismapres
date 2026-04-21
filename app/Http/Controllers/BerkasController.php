<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Berkas;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'nama_berkas' => 'required|string',
            'file' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('berkas');
            
            Berkas::create([
                'mahasiswa_id' => $request->mahasiswa_id,
                'nama_berkas' => $request->nama_berkas,
                'file_path' => $path,
            ]);

            return response()->json(['message' => 'Upload Berkas Berhasil']);
        }

        return response()->json(['message' => 'Upload Berkas Gagal']);
    }
}
