<?php

namespace Database\Seeders;

use App\Models\Parallax;
use Illuminate\Database\Seeder;

class ParallaxSeeder extends Seeder
{
    public function run(): void
    {
        Parallax::create([
            'title' => 'Partners',
            'image' => 'img/parallax/firebreak-parallax-partners.png',
        ],);
        
        Parallax::create([
            'title' => 'CONTÁCTANOS',
            'image' => 'img/parallax/firebreak-parallax-contactanos2.png',
        ],);
    }
}