<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pages\MasterMoverController;
use App\Http\Controllers\Pages\TenteController;


Route::get('/', [HomeController::class, 'index'])->name('home');






Route::prefix('soluciones')->name('solutions.')->group(function () {



    Route::prefix('master-mover')->name('master-mover.')->group(function () {
        Route::get('/soluciones-de-arrastre', [MasterMoverController::class, 'index'])->name('master-mover.solution');
        Route::get('/smartmover', [MasterMoverController::class, 'smartmover'])->name('smartmover');
        Route::get('/mastertow', [MasterMoverController::class, 'mastertow'])->name('mastertow');
        Route::get('/mastertug', [MasterMoverController::class, 'mastertug'])->name('mastertug');
    });

    Route::prefix('tente')->name('tente.')->group(function () {
        Route::get('/supermercados', [TenteController::class, 'supermercados'])->name('supermercados');
        Route::get('/industrial', [TenteController::class, 'industrial'])->name('industrial');
        Route::get('/medico', [TenteController::class, 'medico'])->name('medico');
        Route::get('/panaderia', [TenteController::class, 'panaderia'])->name('panaderia');
    });

});



Route::prefix('servicios')->name('servicios.')->group(function () {
    Route::get('/montaje-y-mantenimiento-metalico', [MasterMoverController::class, 'montajemantenimiento'])->name('montajemantenimiento');
    Route::get('/fabricacion-metalmecanica', [MasterMoverController::class, 'fabricacion'])->name('fabricacion');
    Route::get('/ingenieria-y-diseno', [MasterMoverController::class, 'ingenieria'])->name('ingenieria');
});