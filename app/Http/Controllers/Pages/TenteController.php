<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use Inertia\Inertia;
class TenteController extends Controller
{
    public function supermercados()
    {
        return Inertia::render('Soluciones/Tente/SuperMercado');
    }

    public function industrial()
    {
        return Inertia::render('Soluciones/Tente/Industrial');
    }

    public function medico()
    {
        return Inertia::render('Soluciones/Tente/Medico');
    }
    public function panaderia()
    {
        return Inertia::render('Soluciones/Tente/Panaderia');
    }
}
