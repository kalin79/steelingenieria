<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('footer_blocks', function (Blueprint $table) {
            $table->id();

            // logo | social | menu | text | copyright
            $table->string('type');

            // Titulo visible de la columna: "Mapa de sitio", "Servicios".
            $table->string('title')->nullable();

            // Solo cuando type = menu
            $table->foreignId('menu_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Solo cuando type = text
            $table->text('content')->nullable();

            // column = ocupa column_span de 12 | full = fila completa
            $table->string('width')->default('column');
            $table->unsignedTinyInteger('column_span')->default(3);

            $table->unsignedSmallInteger('position')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['is_active', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_blocks');
    }
};
