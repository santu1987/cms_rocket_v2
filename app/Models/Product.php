<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'product_type_id',
        'code',
        'title',
        'description',
        'price',
        'd_price',
        'img',
        'status',
    ];
    /**
     * Getter y Setter para Price
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            // Al leer de la BD: 1050 -> 10.50
            get: fn (int $value) => $value / 100,
            // Al guardar en la BD: 10.50 -> 1050
            set: fn (float $value) => (int) ($value * 100),
        );
    }

    /**
     * Getter y Setter para D_Price (Precio con descuento)
     */
    protected function dPrice(): Attribute
    {
        return Attribute::make(
            get: fn (?int $value) => $value ? $value / 100 : null,
            set: fn (?float $value) => $value ? (int) ($value * 100) : null,
        );
    }
    /**
     * Accessor para obtener la URL completa de la imagen.
     * Uso: $product->full_image_path
     */
    protected function fullImagePath(): Attribute
    {
        return Attribute::make(
            get: function () {
                // Si no hay imagen, devolvemos una por defecto o null
                if (!$this->img) {
                    return asset('img/no-image.png'); 
                }
                // Genera la URL correcta: /storage/img/products/nombre_imagen.jpg
                return Storage::url($this->img);
            },
        );
    }
    /**
     * Bloque de relaciones
     */
    // Relación inversa: Un producto pertenece a un tipo de producto
    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }
}