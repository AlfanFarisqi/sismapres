<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PenilaianTest extends TestCase
{
    public function test_mahasiswa_penilaian()
    {
        $user = User::where('role', 'mahasiswa')->first();
        if (!$user) {
            $this->markTestSkipped('No mahasiswa user found.');
        }

        $response = $this->actingAs($user)->get('/mahasiswa/penilaian');

        $response->assertStatus(200);
    }
}
