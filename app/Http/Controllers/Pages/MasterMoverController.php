<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

use Inertia\Inertia;

class MasterMoverController extends Controller
{
    public function index()
    {
        return Inertia::render('Soluciones/MasterMover/Index');
    }

    public function smartmover()
    {
        return Inertia::render('Soluciones/MasterMover/Smartmover');

    }

    public function mastertow()
    {
        return Inertia::render('Soluciones/MasterMover/Mastertow');

    }
    public function mastertug()
    {
        return Inertia::render('Soluciones/MasterMover/Mastertug');
    }

    public function montajemantenimiento()
    {
        return Inertia::render('Servicios/Montaje');
    }
    public function fabricacion()
    {
        return Inertia::render('Servicios/Fabricacion');
    }
    public function ingenieria()
    {
        return Inertia::render('Servicios/Ingenieria');
    }
}
