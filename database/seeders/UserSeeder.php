<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario Administrador - Acceso total a Rocket CMS
        User::create([
            'name' => 'Admin Rocket',
            'email' => 'admin@axioma.com',
            'password' => Hash::make('12345678'), // Recuerda cambiarla luego
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Usuario Editor - Para pruebas de contenido
        User::create([
            'name' => 'Editor Sahara',
            'email' => 'sahara@axioma_development.com',
            'password' => Hash::make('editor123'),
            'role' => 'editor',
            'email_verified_at' => now(),
        ]);
    }
}