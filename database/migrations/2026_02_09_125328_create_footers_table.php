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
        Schema::create('footers', function (Blueprint $table) {
            $table->id(); // Autonumérico
            
            // Campos de texto para los títulos
            $table->string('title1');
            $table->string('title2');
            $table->string('title3');
            
            // Datos de contacto y legales
            $table->string('email');
            $table->string('rif');
            $table->string('phone_number');
            
            // Estado booleano
            $table->boolean('status')->default(true);
            
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
