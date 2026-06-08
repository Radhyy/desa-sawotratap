<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'kades@sawotratap.desa.id'],
            [
                'name' => 'Kepala Desa Sawotratap',
                'password' => Hash::make('password'), // default password
                'role' => 'kades',
                'email_verified_at' => now(),
            ]
        );
    }
}
