<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();

            // Unico campo obligatorio del modulo.
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();

            // Accion
            $table->string('link')->nullable();
            $table->string('button_label')->nullable();

            // Icono con su texto acompanante
            $table->foreignId('icon_media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();
            $table->string('icon_description')->nullable();

            // Imagenes por dispositivo. Separadas a proposito: una imagen
            // apaisada recortada en un telefono deja el sujeto fuera de
            // cuadro, y escalar la de escritorio en movil descarga pixeles
            // que nunca se ven.
            $table->foreignId('image_desktop_media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();
            $table->foreignId('image_mobile_media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            // Etiqueta libre para agrupar por ubicacion: home, servicios,
            // master-mover. Permite pedir los banners de una seccion sin
            // crear una tabla por cada una.
            $table->string('collection')->nullable();

            $table->unsignedSmallInteger('position')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['collection', 'is_active', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
