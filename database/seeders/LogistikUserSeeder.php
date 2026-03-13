<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class LogistikUserSeeder extends Seeder
{
    public function run()
    {
        try {
            $role = Role::firstOrCreate(['name' => 'Logistik', 'guard_name' => 'web']);
            
            $user = User::where('email', 'logistik@example.com')->first();
            if (!$user) {
                $user = new User();
                $user->email = 'logistik@example.com';
                $user->name = 'Admin Logistik';
                $user->password = Hash::make('password');
                $user->save();
                echo "User logistik@example.com created.\n";
            } else {
                echo "User logistik@example.com already exists.\n";
            }
            
            $user->assignRole($role);
            echo "Role assigned successfully.\n";
        } catch (\Exception $e) {
            echo "Error seeding: " . $e->getMessage() . "\n";
        }
    }
}
