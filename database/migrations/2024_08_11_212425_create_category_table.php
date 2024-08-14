<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     */
    public function up(): void
    {
        // Crear la tabla 'category'
        Schema::create('category', function (Blueprint $table) {
            $table->id(); // Clave primaria, se autoincrementa
            $table->string('name'); // Nombre de la categoría, como "PlayStation", "XBOX", etc.
            $table->string('description')->nullable(); // Descripción de la categoría, puede ser nula
            $table->string('slug')->unique(); // Slug único, útil para URLs amigables
            $table->string('platform')->nullable(); // Plataforma a la que pertenece la categoría, puede ser nula
            $table->timestamps(); // Campos de marcas de tiempo (created_at, updated_at)
        });
    }

    /**
     * Revierte las migraciones.
     */
    public function down(): void
    {
        // Elimina la tabla 'category' si existe
        Schema::dropIfExists('category');
    }
};
