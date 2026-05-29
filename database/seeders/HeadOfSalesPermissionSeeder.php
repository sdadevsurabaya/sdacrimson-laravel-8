<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HeadOfSalesPermissionSeeder extends Seeder
{
    /**
     * Assign permissions ke role Head Of Sales.
     * Jalankan: php artisan db:seed --class=HeadOfSalesPermissionSeeder
     */
    public function run()
    {
        // Reset cache permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Role::where('name', 'Head Of Sales')->first();

        if (!$role) {
            $this->command->error("Role 'Head Of Sales' tidak ditemukan!");
            return;
        }

        // Daftar permission yang ingin diberikan ke Head Of Sales
        $permissions = [
            'generals-excel-general',
        ];

        foreach ($permissions as $permName) {
            $perm = Permission::firstOrCreate(['name' => $permName]);
            if (!$role->hasPermissionTo($perm)) {
                $role->givePermissionTo($perm);
                $this->command->info("✅ Permission '{$permName}' berhasil di-assign.");
            } else {
                $this->command->warn("⚠️  Permission '{$permName}' sudah ada, dilewati.");
            }
        }

        $this->command->info("Selesai. Total permissions Head Of Sales: " . $role->fresh()->permissions->count());
    }
}
