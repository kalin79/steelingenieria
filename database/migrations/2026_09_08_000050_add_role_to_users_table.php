<?php

use App\Enums\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Se guarda el valor en texto y no como enum de MySQL: agregar
            // un rol nuevo seria una migracion con ALTER de la columna, y
            // en tablas grandes eso bloquea. Con string, sumar un rol es
            // agregar un case al enum de PHP y nada mas.
            //
            // El default admin es a proposito: los usuarios que ya existen
            // fueron creados con make:filament-user y son administradores.
            // Sin default quedarian en null y no podrian entrar al panel.
            $table->string('role', 30)
                ->default(UserRole::Admin->value)
                ->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
