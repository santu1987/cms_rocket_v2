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
            'imagen' => 'img/partners/axioma_logo.png', 
        ]);

        Partner::create([
            'description' => 'Instituto universitario Jesús Obrero',
            'url'=>'',
            'imagen' => 'img/partners/IUJO_logo.gif',
        ]);
    }
}