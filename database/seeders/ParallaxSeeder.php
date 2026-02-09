<?php

namespace Database\Seeders;

use App\Models\Parallax;
use Illuminate\Database\Seeder;

class ParallaxSeeder extends Seeder
{
    public function run(): void
    {
        Parallax::create([
            'title' => 'Nuestra Visión en Movimiento',
            'image' => 'parallax/default-bg.jpg',
        ]);
    }
}