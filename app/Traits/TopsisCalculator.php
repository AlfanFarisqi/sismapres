<?php

namespace App\Traits;

use App\Models\HasilSeleksi;
use App\Models\Mahasiswa;
use App\Models\Kriteria;

trait TopsisCalculator
{
    public function calculateTopsis()
    {
        $mahasiswas = Mahasiswa::with('penilaians')->where('status_berkas', 'lolos')->get();
        $kriterias = Kriteria::all();

        if ($mahasiswas->isEmpty() || $kriterias->isEmpty()) {
            return false;
        }

        // 1. Matrix Keputusan (X)
        $matrix = [];
        foreach ($mahasiswas as $m) {
            foreach ($kriterias as $k) {
                $penilaian = $m->penilaians->where('kriteria_id', $k->id)->first();
                $matrix[$m->id][$k->id] = $penilaian ? $penilaian->nilai : 0;
            }
        }

        // 2. Normalisasi Matrix (R)
        $divider = [];
        foreach ($kriterias as $k) {
            $sumSquared = 0;
            foreach ($mahasiswas as $m) {
                $sumSquared += pow($matrix[$m->id][$k->id], 2);
            }
            $divider[$k->id] = sqrt($sumSquared);
        }

        $normalizedMatrix = [];
        foreach ($mahasiswas as $m) {
            foreach ($kriterias as $k) {
                $normalizedMatrix[$m->id][$k->id] = $divider[$k->id] != 0 ? $matrix[$m->id][$k->id] / $divider[$k->id] : 0;
            }
        }

        // 3. Matrix Terbobot (Y)
        $weightedMatrix = [];
        foreach ($mahasiswas as $m) {
            foreach ($kriterias as $k) {
                $weightedMatrix[$m->id][$k->id] = $normalizedMatrix[$m->id][$k->id] * $k->bobot;
            }
        }

        // 4. Solusi Ideal Positif (A+) dan Negatif (A-)
        $idealPositive = [];
        $idealNegative = [];
        foreach ($kriterias as $k) {
            $values = [];
            foreach ($mahasiswas as $m) {
                $values[] = $weightedMatrix[$m->id][$k->id];
            }

            if ($k->jenis == 'benefit') {
                $idealPositive[$k->id] = !empty($values) ? max($values) : 0;
                $idealNegative[$k->id] = !empty($values) ? min($values) : 0;
            } else {
                $idealPositive[$k->id] = !empty($values) ? min($values) : 0;
                $idealNegative[$k->id] = !empty($values) ? max($values) : 0;
            }
        }

        // 5. Jarak Solusi Ideal Positif (D+) dan Negatif (D-)
        $distPositive = [];
        $distNegative = [];
        foreach ($mahasiswas as $m) {
            $sumPos = 0;
            $sumNeg = 0;
            foreach ($kriterias as $k) {
                $sumPos += pow($weightedMatrix[$m->id][$k->id] - $idealPositive[$k->id], 2);
                $sumNeg += pow($weightedMatrix[$m->id][$k->id] - $idealNegative[$k->id], 2);
            }
            $distPositive[$m->id] = sqrt($sumPos);
            $distNegative[$m->id] = sqrt($sumNeg);
        }

        // 6. Nilai Preferensi (V)
        $preferences = [];
        foreach ($mahasiswas as $m) {
            $totalDist = $distPositive[$m->id] + $distNegative[$m->id];
            $preferences[$m->id] = $totalDist != 0 ? $distNegative[$m->id] / $totalDist : 0;
        }

        // 7. Simpan Hasil dan Ranking
        arsort($preferences);
        
        HasilSeleksi::truncate();
        
        $ranking = 1;
        foreach ($preferences as $mahasiswaId => $score) {
            HasilSeleksi::create([
                'mahasiswa_id' => $mahasiswaId,
                'total_skor' => $score,
                'ranking' => $ranking++
            ]);
        }

        return true;
    }
}
