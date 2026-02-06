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
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo1')->nullable();
            $table->string('titulo2')->nullable();
            $table->string('titulo3')->nullable();
            $table->string('cta')->nullable(); // Call to Action (Texto del botón)
            $table->string('url_cta')->nullable();
            $table->string('img')->nullable(); // Ruta de la imagen
            $table->string('video')->nullable(); // Ruta o link del video
            $table->boolean('status')->default(true); // Activo/Inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
