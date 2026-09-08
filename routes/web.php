<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pages\MasterMoverController;
use App\Http\Controllers\Pages\TenteController;
use App\Http\Controllers\Pages\ContactenosController;
use App\Http\Controllers\Pages\ProyectoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ContactoTenteController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contactenos', [ContactenosController::class, 'index'])->name('contactenos');

// Listado y ficha de proyectos. El detalle va en singular por pedido y
// resuelve por slug: Project::getRouteKeyName() devuelve 'slug', asi que
// no hace falta escribir {project:slug} aca.
Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
Route::get('/proyecto/{project}', [ProyectoController::class, 'show'])->name('proyectos.show');



Route::post('/contacto', [ContactoController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contacto.store');

// Formulario de la landing TENTE: mismos datos personales, sin el campo
// "solucion". Ruta propia para que cada formulario tenga su FormRequest y
// su propio limite de envios, en vez de reglas condicionales en uno solo.
Route::post('/contacto/tente', [ContactoTenteController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contacto.tente.store');


Route::prefix('soluciones')->name('solutions.')->group(function () {



    Route::prefix('master-mover')->name('master-mover.')->group(function () {
        Route::get('/soluciones-de-arrastre', [MasterMoverController::class, 'index'])->name('master-mover.solution');
        Route::get('/smartmover', [MasterMoverController::class, 'smartmover'])->name('smartmover');
        Route::get('/mastertow', [MasterMoverController::class, 'mastertow'])->name('mastertow');
        Route::get('/mastertug', [MasterMoverController::class, 'mastertug'])->name('mastertug');
    });

    Route::prefix('tente')->name('tente.')->group(function () {
        Route::get('/soluciones-de-movilidad-con-tente', [TenteController::class, 'index'])->name('tente.index');
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