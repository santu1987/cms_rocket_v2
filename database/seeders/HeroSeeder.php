<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    public function run(): void
    {
        Hero::create([
            'titulo1' => 'Calidad y seguridad garantizada para tu vehículo',
            'titulo2' => 'Frena con confianza en cada kilómetro',
            'titulo3' => '',
            'cta' => 'COMPRA TUS FRENOS HOY!',
            'url_cta' => '#productos',
            'status' => true,
        ]);
    }
}
