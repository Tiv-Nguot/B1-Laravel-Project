<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Throwable;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     * @throws Throwable
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(['email' => 'admin@gmail.com'], [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '090 979 8899',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'image_profile' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8slgZXgqnSIXDS8wF2uDT_SmsYlBe-W1soQ&s',
            'remember_token' => Str::random(0),
        ]);
        $admin->syncRoles(Role::all());
        $admin->syncPermissions(Permission::all());
        
        $user = User::firstOrCreate(['email' => 'user@gmail.com'], [
            'name' => 'User',
            'email' => 'user@gmail.com',
            'phone' => '098 979 8899',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'image_profile' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTG-5Wi8qZXluHi11q-AHGh8riznXRoltGVYQ&s',
            'remember_token' => Str::random(20),
        ]);
        $user->syncRoles(["User"]);
        $user->syncPermissions(["view_users","view_roles", "view_permissions"]);
    }
}
