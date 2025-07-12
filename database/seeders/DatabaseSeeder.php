<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Guru 1',
            'email' => 'guru@example.com',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        User::factory()->create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepala@example.com',
            'password' => bcrypt('password'),
            'role' => 'kepala_sekolah',
        ]);

        User::factory()->create([
            'name' => 'Admin Sarpras',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'administrasi',
        ]);
    }
}
