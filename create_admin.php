<?php
define('LARAVEL_START', microtime(true));
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$u = User::firstOrNew(['email' => 'admin@med.com']);
$u->name = 'Admin Med';
$u->password = Hash::make('password');
$u->role = 'admin';
$u->save();

echo "ADMIN_CREATED_SUCCESS\n";
echo "Email: admin@med.com\n";
echo "Password: password\n";
