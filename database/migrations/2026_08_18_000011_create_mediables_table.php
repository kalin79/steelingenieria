<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mediables', function (Blueprint $table) {
            $table->id();

            $table->foreignId('media_id')
                ->constrained('media')
                ->cascadeOnDelete();

            $table->morphs('mediable');

            // Permite que un mismo modelo tenga varios grupos de archivos:
            // galeria, ficha-tecnica, portada.
            $table->string('collection')->default('default');

            $table->unsignedSmallInteger('position')->default(0);

            $table->timestamps();

            $table->unique(['media_id', 'mediable_type', 'mediable_id', 'collection'], 'mediables_unique');
            $table->index(['mediable_type', 'mediable_id', 'collection', 'position'], 'mediables_lookup');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mediables');
    }
};
