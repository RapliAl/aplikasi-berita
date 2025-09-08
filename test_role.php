<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

$user = User::find(1);

echo "=== Role Testing ===\n";
echo "User: " . $user->name . " (ID: " . $user->id . ")\n";
echo "Email: " . $user->email . "\n";
echo "Has Admin Role: " . ($user->hasRole('Admin') ? 'YES' : 'NO') . "\n";
echo "Has Author Role: " . ($user->hasRole('Author') ? 'YES' : 'NO') . "\n";
echo "Has Reader Role: " . ($user->hasRole('Reader') ? 'YES' : 'NO') . "\n";
echo "Has Admin OR Author: " . ($user->hasRole(['Admin', 'Author']) ? 'YES' : 'NO') . "\n";
echo "Has Any Admin/Author: " . ($user->hasAnyRole(['Admin', 'Author']) ? 'YES' : 'NO') . "\n";

echo "\n=== All User Roles ===\n";
foreach ($user->roles as $role) {
    echo "- " . $role->name . "\n";
}

echo "\n=== All Permissions ===\n";
foreach ($user->getAllPermissions() as $permission) {
    echo "- " . $permission->name . "\n";
}
