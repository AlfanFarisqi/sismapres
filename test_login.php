<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

use Illuminate\Http\Request;

$request = Request::create('/login', 'POST', [
    'login' => 'admin123',
    'password' => 'admin123',
]);

$response = $kernel->handle($request);

echo "Status: " . $response->getStatusCode() . "\n";
echo "Location: " . $response->headers->get('Location') . "\n";
if ($response->getStatusCode() == 302) {
    // follow redirect
    $req2 = Request::create($response->headers->get('Location'), 'GET');
    $res2 = $kernel->handle($req2);
    echo "Follow Status: " . $res2->getStatusCode() . "\n";
}
