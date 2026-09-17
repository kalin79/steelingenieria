<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Se desactiva en vez de borrar: eliminar la cuenta de alguien
            // que dejo la empresa borra tambien el rastro de quien subio
            // cada archivo a la biblioteca (media.uploaded_by).
            $table->boolean('is_active')
                ->default(true)
                ->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
