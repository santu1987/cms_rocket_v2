<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'code'        => 'PAST-001',
                'title'       => 'Pastillas',
                'description' => 'Pastillas de freno de alta cerámica y semimetálicas.',
                'order'       => 1,
                'status'      => 1,
            ],
            [
                'code'        => 'DISC-002',
                'title'       => 'Discos',
                'description' => 'Discos de freno ventilados y sólidos para todo tipo de vehículos.',
                'order'       => 2,
                'status'      => 1,
            ],
            [
                'code'        => 'LIG-003',
                'title'       => 'Ligas',
                'description' => 'Ligas de freno DOT3 y DOT4 de alto rendimiento.',
                'order'       => 3,
                'status'      => 1,
            ],
            [
                'code'        => 'OTH-004',
                'title'       => 'Otros',
                'description' => 'Componentes adicionales y accesorios del sistema de frenado.',
                'order'       => 4,
                'status'      => 1,
            ],
        ];

        foreach ($types as $type) {
            ProductType::create($type);
        }
    }
}