<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->id(); // ID Autonumérico
            $table->string('code')->unique(); // Código único del tipo de producto
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('order')->default(0); // Para organizar la jerarquía visual
            $table->boolean('status')->default(1); // 0 = Inactivo, 1 = Activo
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_types');
    }
};
