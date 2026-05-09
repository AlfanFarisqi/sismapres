<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Mahasiswa;
use App\Models\Penilaian;
use App\Http\Controllers\PenilaianController;
use Illuminate\Http\Request;

$mahasiswa = Mahasiswa::first();
if (!$mahasiswa) {
    echo "No mahasiswa.\n";
    exit;
}
$mahasiswa->status_berkas = 'lolos';
$mahasiswa->save();

$controller = new PenilaianController();
$request = Request::create('/admin/data-penilaian', 'POST', [
    'mahasiswa_id' => $mahasiswa->id,
    'nilai' => [
        1 => 4,
        2 => 5,
        3 => 3,
        4 => 4,
        5 => 5
    ]
]);

// Set session
$request->setLaravelSession(app('session')->driver());

try {
    $response = $controller->store($request);
    echo "Response status: " . $response->getStatusCode() . "\n";
    
    // Dump session errors/messages
    $session = $request->session();
    echo "Success: " . $session->get('success') . "\n";
    echo "Error: " . $session->get('error') . "\n";
    if ($session->has('errors')) {
        echo "Validation Errors: " . json_encode($session->get('errors')->getBag('default')->getMessages()) . "\n";
    }

    $penilaians = Penilaian::where('mahasiswa_id', $mahasiswa->id)->get();
    echo "Saved penilaians: " . $penilaians->count() . "\n";
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}
