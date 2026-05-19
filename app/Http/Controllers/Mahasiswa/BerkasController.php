<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    private function getMahasiswa()
    {
        return Mahasiswa::where('user_id', Auth::id())->first();
    }

    public function index()
    {
        $mahasiswa = $this->getMahasiswa();
        $berkas = $mahasiswa ? $mahasiswa->berkas->pluck('file_path', 'nama_berkas') : collect();
        
        return view('mahasiswa.berkas', compact('mahasiswa', 'berkas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'berkas' => 'nullable|array',
            'berkas.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $mahasiswa = $this->getMahasiswa();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Silakan lengkapi profil terlebih dahulu.');
        }

        if ($request->has('berkas') && is_array($request->file('berkas'))) {
            foreach ($request->file('berkas') as $nama_berkas => $file) {
                $filename = $mahasiswa->npm . '_' . str_replace(' ', '_', $nama_berkas) . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('berkas', $filename, 'public');

                $existingBerkas = Berkas::where('mahasiswa_id', $mahasiswa->id)
                                        ->where('nama_berkas', $nama_berkas)
                                        ->first();

                if ($existingBerkas) {
                    if (Storage::disk('public')->exists($existingBerkas->file_path)) {
                        Storage::disk('public')->delete($existingBerkas->file_path);
                    }
                    $existingBerkas->update(['file_path' => $path]);
                } else {
                    Berkas::create([
                        'mahasiswa_id' => $mahasiswa->id,
                        'nama_berkas' => $nama_berkas,
                        'file_path' => $path,
                    ]);
                }
            }
        }

        return redirect()->route('mahasiswa.penilaian.index')->with('success', 'Berkas berhasil disimpan.');
    }
}
