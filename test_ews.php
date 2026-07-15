<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$ids = \App\Models\Inokulasi::whereHas('productionReports', function($q) {
    $q->where('status_validasi', '!=', 'dibatalkan');
}, '<', 5)->pluck('id')->toArray();

echo json_encode($ids);
