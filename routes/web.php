<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pages\MasterMoverController;


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get(
    '/soluciones-de-arrastre-con-master-move',
    [MasterMoverController::class, 'index']
)->name('master-mover.solution');