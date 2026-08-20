<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Support\JsonLd;
use App\Support\Seo;
use Inertia\Inertia;
class HomeController extends Controller
{
    public function index()
    {
        $seo = Seo::make('Soluciones industriales en ingeniería, fabricación y montaje metálico')
            ->description('Diseño, fabricación y montaje de proyectos industriales para los sectores minero, logístico, manufacturero y alimentario. 15 años de experiencia y más de 500 proyectos ejecutados en Perú.')
            ->image('/images/og/montaje.jpg')
            ->schema(JsonLd::service(
                nombre: 'Soluciones industriales en ingeniería, fabricación y montaje metálico',
                descripcion: 'Diseño, fabricación y montaje de proyectos industriales para los sectores minero, logístico, manufacturero y alimentario. ',
                area: 'Perú',
            ))
            ->schema(JsonLd::breadcrumb([
                ['name' => 'Inicio', 'url' => '/'],
                ['name' => 'Servicios', 'url' => '/servicios'],
                ['name' => 'Soluciones industriales en ingeniería, fabricación y montaje metálico', 'url' => '/servicios/montaje-y-mantenimiento-metalico'],
            ]))
            ->schema(JsonLd::faq([
                [
                    'pregunta' => '¿Qué incluye el servicio de montaje metálico?',
                    'respuesta' => 'Incluye la evaluación en sitio, la ingeniería de detalle, la fabricación de las piezas, el traslado y el montaje en obra con personal certificado en trabajos en altura.',
                ],
                [
                    'pregunta' => '¿En qué sectores trabajan?',
                    'respuesta' => 'Minero, logístico, manufacturero y alimentario, con más de 500 proyectos ejecutados en 15 años de operación.',
                ],
            ]));
        // return Inertia::render('Home');
        return Inertia::render('Home', [
            'seo' => $seo->toArray(),
        ]);
    }
}
