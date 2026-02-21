<?php

namespace Database\Seeders;

use App\Models\SocialNetwork;
use Illuminate\Database\Seeder;

class SocialNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $networks = [
            [
                'name' => 'Instagram',
                'description' => 'Perfil oficial de fotografía y Reels',
                'link' => 'https://www.instagram.com/rocket_cms',
            ],
            [
                'name' => 'Facebook',
                'description' => 'Fanpage para comunidad y noticias',
                'link' => 'https://www.facebook.com/rocketcms.v2',
            ],
            [
                'name' => 'X.com',
                'description' => 'Cuenta para actualizaciones rápidas y soporte',
                'link' => 'https://x.com/rocket_cms',
            ],
            [
                'name' => 'WhatsApp',
                'description' => 'Canal de atención directa al cliente',
                'link' => 'https://wa.me/584120000000',
            ],
        ];

        foreach ($networks as $network) {
            SocialNetwork::create($network);
        }
    }
}