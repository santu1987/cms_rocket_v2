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
        Schema::create('parallaxes', function (Blueprint $table) {
            $table->id(); // ID Autonumérico
            $table->string('title'); // Título que flota sobre el efecto
            $table->string('image'); // Ruta de la imagen de fondo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parallaxes');
    }
};
