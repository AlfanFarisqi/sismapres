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
            'nama_berkas' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $mahasiswa = $this->getMahasiswa();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Silakan lengkapi profil terlebih dahulu.');
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $mahasiswa->npm . '_' . str_replace(' ', '_', $request->nama_berkas) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('berkas', $filename, 'public');

            $existingBerkas = Berkas::where('mahasiswa_id', $mahasiswa->id)
                                    ->where('nama_berkas', $request->nama_berkas)
                                    ->first();

            if ($existingBerkas) {
                if (Storage::disk('public')->exists($existingBerkas->file_path)) {
                    Storage::disk('public')->delete($existingBerkas->file_path);
                }
                $existingBerkas->update(['file_path' => $path]);
            } else {
                Berkas::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'nama_berkas' => $request->nama_berkas,
                    'file_path' => $path,
                ]);
            }

            return redirect()->back()->with('success', 'Berkas ' . $request->nama_berkas . ' berhasil diunggah.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah berkas.');
    }
}
