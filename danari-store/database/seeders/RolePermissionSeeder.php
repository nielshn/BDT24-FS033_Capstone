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
        $adminRole = Role::create([
            'name' => 'admin',
        ]);

        $userRole = Role::create([
            'name' => 'user',
        ]);

        $userOwner = User::create([
            'name' => 'DANARI STORE',
            'email' => 'dsiahaan581@gmail.com',
            'password' => bcrypt('danari@store'),
        ]);

        $userOwner->assignRole($adminRole);
    }
}
