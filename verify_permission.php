<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// Cek role
$role = Role::where('name', 'Head Of Sales')->first();
if (!$role) {
    echo "❌ Role 'Head Of Sales' TIDAK ditemukan di database ini!\n";
    exit;
}

echo "✅ Role ditemukan: " . $role->name . "\n";

// Cek permissions
$perms = $role->permissions;
if ($perms->isEmpty()) {
    echo "⚠️  Role ini BELUM punya permission apapun. Assign sekarang...\n";
    $perm = Permission::firstOrCreate(['name' => 'generals-excel-general']);
    $role->givePermissionTo($perm);
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    echo "✅ Permission 'generals-excel-general' berhasil di-assign!\n";
} else {
    echo "Permissions yang dimiliki:\n";
    foreach ($perms as $p) {
        echo "  ✅ " . $p->name . "\n";
    }
}
