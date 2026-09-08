<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Support\JsonLd;
use App\Support\Seo;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Pagina /contactenos.
 *
 * Solo RENDERIZA la vista. El envio del formulario no pasa por aca: el
 * componente Contacto.vue postea a /contacto, que ya resuelve
 * ContactoController@store con su ContactoRequest. Separar "mostrar la
 * pagina" de "recibir el formulario" evita que un cambio en el formulario
 * obligue a tocar el SEO de la pagina, y viceversa.
 */
class ContactenosController extends Controller
{
    public function index(): Response
    {
        $seo = Seo::make('Contáctenos')
            ->description('Escríbenos y te respondemos a la brevedad. Cotizaciones de ingeniería, fabricación metalmecánica, montaje industrial y soluciones de movilidad para tu operación.')
            ->canonical('/contactenos')
            ->schema(JsonLd::breadcrumb([
                ['name' => 'Inicio', 'url' => '/'],
                ['name' => 'Contáctenos', 'url' => '/contactenos'],
            ]));

        return Inertia::render('Contactenos', [
            'seo' => $seo->toArray(),
            // Esta pagina monta la misma seccion de proyectos que el home.
            'proyectos' => Project::ultimos(5),
        ]);
    }
}
