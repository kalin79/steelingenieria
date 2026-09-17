<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
         * Longitud por defecto de las columnas string: 191 en vez de 255.
         *
         * Con utf8mb4 cada caracter ocupa 4 bytes, asi que un varchar(255)
         * son 1020 bytes. InnoDB en formato COMPACT admite hasta 767 bytes
         * por columna indexada, y MyISAM 1000 por indice completo: cualquier
         * indice que incluya una de esas columnas falla con el error 1071.
         *
         * 191 x 4 = 764 bytes, por debajo del limite mas restrictivo. Es el
         * ajuste estandar para servidores con MySQL anterior a 5.7.7.
         *
         * Solo afecta a las tablas que se creen de aqui en adelante; las
         * existentes conservan su definicion.
         */
        Schema::defaultStringLength(191);
    }
}
