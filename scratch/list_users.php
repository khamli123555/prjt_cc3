<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(Illuminate\Http\Request::capture());

use App\Models\User;
$users = User::all(['name', 'email', 'role']);
foreach($users as $user) {
    echo "{$user->name} | {$user->email} | {$user->role}\n";
}
