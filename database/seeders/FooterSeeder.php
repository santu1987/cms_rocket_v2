<?php

namespace Database\Seeders;
use App\Models\Footer;
use Illuminate\Database\Seeder;

class FooterSeeder extends Seeder
{
    public function run(): void
    {
        Footer::create([
            'title1' => 'Rocket CMS v2',
            'title2' => 'Navegación',
            'title3' => 'Contáctanos',
            'email' => 'contacto@tuweb.com',
            'rif' => 'J-12345678-9',
            'phone_number' => '+58 412 000 0000',
            'status' => true,
        ]);
    }
}