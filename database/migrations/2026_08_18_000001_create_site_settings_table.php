<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            // Identidad
            $table->string('site_name')->default('Steel Ingenieria');
            $table->string('logo_header')->nullable();
            $table->string('logo_footer')->nullable();
            $table->string('logo_alt')->nullable();

            // Datos de la empresa. Alimentan el footer y, mas adelante,
            // el JSON-LD de Organization sin duplicar informacion.
            $table->string('legal_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();

            // Acepta el placeholder {year}, que se reemplaza al renderizar.
            $table->string('copyright')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
