<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'nama' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'owner'
        ]);

        User::create([
            'nama' => 'staf',
            'email' => 'staf@gmail.com',
            'password' => Hash::make('staf123'),
            'role' => 'staf'
        ]);

        User::create([
            'nama' => 'penghuni',
            'email' => 'penghuni@gmail.com',
            'password' => Hash::make('penghuni123'),
            'role' => 'penghuni'
        ]);
    }
}
