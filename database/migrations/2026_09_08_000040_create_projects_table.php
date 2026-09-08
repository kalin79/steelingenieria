<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            // El slug es la URL publica: /proyecto/{slug}. Unico a nivel
            // de base y no solo de aplicacion, porque dos editores
            // guardando al mismo tiempo pueden pasar la validacion de PHP
            // y aun asi chocar. El indice unico es la ultima defensa.
            $table->string('slug')->unique();

            $table->string('subtitle')->nullable();

            // Contenido enriquecido del detalle. longText porque una
            // descripcion con formato guarda HTML, y text se queda corto
            // apenas el editor pega tres parrafos con listas.
            $table->longText('description')->nullable();

            $table->string('client')->nullable();

            // Texto libre a proposito: admite "Marzo 2024", "6 meses" o
            // "2023 - 2024". Si algun dia hace falta ordenar por fecha,
            // se agrega una columna date aparte sin migrar esta.
            $table->string('execution')->nullable();

            // Imagenes de la tarjeta en el listado /proyectos.
            $table->foreignId('image_desktop_media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();
            $table->foreignId('image_mobile_media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            // Imagenes de cabecera del detalle. Separadas de las de la
            // tarjeta: la portada de una grilla y un banner a pantalla
            // completa piden recortes distintos del mismo proyecto.
            $table->foreignId('banner_desktop_media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();
            $table->foreignId('banner_mobile_media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            // SEO por proyecto. Se guardan aparte del titulo y la
            // descripcion visibles porque el texto que convierte en
            // pantalla y el que funciona en un resultado de busqueda
            // rara vez son el mismo: uno tiene la marca y el gancho, el
            // otro tiene la palabra que la gente escribe en Google.
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('seo_description', 320)->nullable();
            $table->foreignId('seo_image_media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            $table->unsignedSmallInteger('position')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Cubre la consulta del listado publico: filtrar por activo y
            // ordenar por posicion en una sola pasada del indice.
            $table->index(['is_active', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
