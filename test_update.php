<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Mahasiswa;
use App\Models\User;

$user = User::first();
if (!$user) {
    echo "No user found.\n";
    exit;
}

// simulate uploadFoto
$mahasiswa = Mahasiswa::firstOrCreate(
    ['user_id' => $user->id],
    [
        'nama' => $user->name,
        'email' => $user->email,
        'status_berkas' => 'belum',
    ]
);

echo "After uploadFoto, NPM is: " . ($mahasiswa->npm ?? 'NULL') . "\n";

// simulate update
$mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
$mahasiswa->update([
    'nama' => 'Updated Name',
    'npm' => '12345678',
    'tingkat' => 3,
    'no_hp' => '08123456789',
    'alamat' => 'Jl. Test',
]);

$mahasiswa->refresh();
echo "After update, NPM is: " . ($mahasiswa->npm ?? 'NULL') . "\n";
