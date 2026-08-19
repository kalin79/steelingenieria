<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();

            // image | document | video
            $table->string('type');

            // Agrupacion libre para filtrar en el panel: banners,
            // proyectos, fichas-tecnicas, certificados.
            $table->string('collection')->nullable();

            $table->string('disk')->default('public');
            $table->string('path');
            $table->string('original_name');
            $table->string('mime_type')->nullable();
            $table->string('extension', 12)->nullable();
            $table->unsignedBigInteger('size')->default(0);

            // Se completan solos al subir una imagen. Son los que evitan
            // el desplazamiento de layout al renderizar.
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();

            // Segundos. Solo aplica a video y se carga a mano salvo que
            // el servidor tenga ffprobe disponible.
            $table->unsignedInteger('duration')->nullable();

            // Metadatos de contenido
            $table->string('title')->nullable();
            $table->string('alt')->nullable();
            $table->text('caption')->nullable();

            // Imagen de portada para videos. Sin poster, el navegador
            // descarga los primeros fotogramas para mostrar algo.
            $table->foreignId('poster_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            $table->foreignId('uploaded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['type', 'collection']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
