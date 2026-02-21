<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Obtenemos los IDs de los tipos creados anteriormente
        $pastillas = ProductType::where('title', 'Pastillas')->first();
        $discos    = ProductType::where('title', 'Discos')->first();
        $ligas     = ProductType::where('title', 'Ligas')->first();
        $otros     = ProductType::where('title', 'Otros')->first();

        $products = [
            // Productos para Pastillas
            [
                'product_type_id' => $pastillas->id,
                'code' => 'PAST-CER-001',
                'title' => 'Pastillas Cerámicas Ultra Stop',
                'description' => 'Alta resistencia al calor y mínimo ruido.',
                'price' => 45.99, // Se guardará como 4599
                'd_price' => 39.50,
                'img' => 'img/products/pastillas_1.png',
                'status' => 1,
            ],
            [
                'product_type_id' => $pastillas->id,
                'code' => 'PAST-SEM-002',
                'title' => 'Pastillas Semimetálicas Pro',
                'description' => 'Ideal para carga pesada y durabilidad extrema.',
                'price' => 32.00,
                'd_price' => null,
                'img' => 'img/products/pastillas_1.png',
                'status' => 1,
            ],

            // Productos para Discos
            [
                'product_type_id' => $discos->id,
                'code' => 'DISC-VENT-001',
                'title' => 'Disco Ventilado Delantero',
                'description' => 'Diseño con flujo de aire optimizado.',
                'price' => 85.00,
                'd_price' => 79.99,
                'img' => 'img/products/disco_1.png',
                'status' => 1,
            ],
            [
                'product_type_id' => $discos->id,
                'code' => 'DISC-SOL-002',
                'title' => 'Disco Sólido Trasero',
                'description' => 'Acero de alta calidad para frenado suave.',
                'price' => 55.50,
                'd_price' => null,
                'img' => 'img/products/disco_1.png',
                'status' => 1,
            ],

            // Productos para Ligas
            [
                'product_type_id' => $ligas->id,
                'code' => 'LIG-DOT4-001',
                'title' => 'Liga de Freno DOT 4 (500ml)',
                'description' => 'Punto de ebullición elevado para sistemas ABS.',
                'price' => 12.00,
                'd_price' => 10.50,
                'img' => 'img/products/liga_1.png',
                'status' => 1,
            ],
            [
                'product_type_id' => $ligas->id,
                'code' => 'LIG-DOT3-002',
                'title' => 'Liga de Freno DOT 3 (250ml)',
                'description' => 'Uso estándar para vehículos livianos.',
                'price' => 7.25,
                'd_price' => null,
                'img' => 'img/products/liga_1.png',
                'status' => 1,
            ],

            // Productos para Otros
            [
                'product_type_id' => $otros->id,
                'code' => 'OTH-CLEAN-001',
                'title' => 'Limpiador de Frenos en Spray',
                'description' => 'Remueve grasa y polvo de asbesto instantáneamente.',
                'price' => 15.00,
                'd_price' => null,
                'img' => 'img/products/liga_1.png',
                'status' => 1,
            ],
            [
                'product_type_id' => $otros->id,
                'code' => 'OTH-KIT-002',
                'title' => 'Kit de Resortes y Herrajes',
                'description' => 'Kit completo para instalación de bandas traseras.',
                'price' => 22.40,
                'd_price' => 18.00,
                'img' => 'img/products/liga_1.png',
                'status' => 1,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}