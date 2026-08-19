<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('social_links', function (Blueprint $table) {
            $table->foreignId('icon_media_id')
                ->nullable()
                ->after('url')
                ->constrained('media')
                ->nullOnDelete();
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->foreignId('logo_header_media_id')
                ->nullable()
                ->after('logo_header')
                ->constrained('media')
                ->nullOnDelete();

            $table->foreignId('logo_footer_media_id')
                ->nullable()
                ->after('logo_footer')
                ->constrained('media')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('social_links', function (Blueprint $table) {
            $table->dropConstrainedForeignId('icon_media_id');
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('logo_header_media_id');
            $table->dropConstrainedForeignId('logo_footer_media_id');
        });
    }
};
