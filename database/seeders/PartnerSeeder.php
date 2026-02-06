<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        Partner::create([
            'description' => 'Axioma debvelopers.',
            'url'=>'',
            'imagen' => 'partners/logo-default.png', // Ruta simulada
        ]);

        Partner::create([
            'description' => 'Instituto universitario Jesús Obrero',
            'url'=>'',
            'imagen' => 'partners/logo-default-2.png',
        ]);
    }
}