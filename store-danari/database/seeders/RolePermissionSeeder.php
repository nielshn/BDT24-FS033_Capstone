<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'customer']);
        Role::create(['name' => 'seller']);
        $adminRole = Role::create(['name' => 'admin']);

        $userOwner = User::create([
            'name' => 'DANARI STORE',
            'email' => 'dsiahaan581@gmail.com',
            'password' => bcrypt('danari@store'),
            'avatar' => 'images/user-icon.png',
        ]);

        // Assign role to the admin user
        $userOwner->assignRole($adminRole);
    }
}
