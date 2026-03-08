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
            'desc1' => 'Frena con confianza en cada Kilometro',
            'desc2' => 'Compra tus frenos aquí hoy!.',
            'desc3' => '<i class="bi bi-globe"></i> Caracas, Distrito Capital, Venezuela',
            'desc4' => '<i class="bi bi-rocket-takeoff-fill"></i> Con propósito By Axioma Development_',
            'email' => 'contacto@tuweb.com',
            'rif' => 'J-12345678-9',
            'phone_number' => '+58 412 000 0000',
            'status' => true,
        ]);
    }
}