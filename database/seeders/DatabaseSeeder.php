<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        $admin = Role::firstOrCreate(
            ['name' => 'admin'],
            ['description' => 'Admin']
        );

        User::firstOrcreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'role_id' => $admin->id,
            ],
        );

        // Dokter
        $dokter = Role::firstOrCreate(
            ['name' => 'dokter'],
            ['description' => 'Dokter']
        );

        User::firstOrcreate(
            ['email' => 'dokter@dokter.com',],
            [
                'name' => 'Dokter',
                'password' => bcrypt('password'),
                'role_id' => $dokter->id,
            ]
        );

        // Apoteker
        $apoteker = Role::firstOrCreate(
            ['name' => 'apoteker'],
            ['description' => 'Apoteker']
        );

        User::firstOrcreate(
            ['email' => 'apoteker@apoteker.com',],
            [
                'name' => 'Apoteker',
                'password' => bcrypt('password'),
                'role_id' => $apoteker->id,
            ]
        );
    }
}
