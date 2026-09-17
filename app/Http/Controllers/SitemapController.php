<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/**
 * Sitemap y robots.txt generados por la aplicacion.
 *
 * Se generan en vivo y no como archivos estaticos por dos razones: cada
 * proyecto que el equipo publica desde el panel entra solo, sin que nadie
 * regenere nada; y el dominio sale de url(), asi que el mismo codigo
 * funciona en local, en pruebas y en produccion sin editar nada.
 */
class SitemapController extends Controller
{
    /**
     * Paginas fijas del sitio, por nombre de ruta.
     *
     * Se listan a mano y no se recorre el router completo a proposito: un
     * sitemap automatico terminaria publicando /admin, /up y cualquier
     * ruta interna que se agregue despues. Aca lo que entra, entra porque
     * alguien lo decidio.
     *
     * @var array<int, string>
     */
    private const RUTAS_FIJAS = [
        'home',
        'contactenos',
        'proyectos.index',

        'servicios.montajemantenimiento',
        'servicios.fabricacion',
        'servicios.ingenieria',

        'solutions.master-mover.master-mover.solution',
        'solutions.master-mover.smartmover',
        'solutions.master-mover.mastertow',
        'solutions.master-mover.mastertug',

        'solutions.tente.tente.index',
        'solutions.tente.supermercados',
        'solutions.tente.industrial',
        'solutions.tente.medico',
        'solutions.tente.panaderia',
    ];

    public function sitemap(): Response
    {
        $urls = [];

        foreach (self::RUTAS_FIJAS as $nombre) {
            // Si alguien renombra o elimina una ruta, se omite en vez de
            // tumbar el sitemap entero con una excepcion.
            if (! Route::has($nombre)) {
                continue;
            }

            // Sin lastmod: no hay una fecha real de modificacion para una
            // pagina fija. Poner la de hoy en cada visita es peor que
            // omitirla, porque Google deja de confiar en el campo cuando
            // detecta que siempre cambia.
            $urls[] = ['loc' => route($nombre), 'lastmod' => null];
        }

        Project::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->get(['slug', 'updated_at'])
            ->each(function (Project $proyecto) use (&$urls) {
                $urls[] = [
                    'loc' => url("/proyecto/{$proyecto->slug}"),
                    // Aca si es una fecha real: la ultima edicion de la
                    // ficha. Es el dato que Google usa para decidir cuando
                    // volver a rastrearla.
                    'lastmod' => $proyecto->updated_at?->toAtomString(),
                ];
            });

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    /**
     * robots.txt.
     *
     * Fuera de produccion bloquea todo el sitio. Es la proteccion mas
     * barata contra el error clasico de que un entorno de pruebas termine
     * indexado y compita con el sitio real por las mismas busquedas.
     */
    public function robots(): Response
    {
        $lineas = ['User-agent: *'];

        if (app()->environment('production')) {
            $lineas[] = 'Disallow: /admin';
            $lineas[] = 'Allow: /';
            $lineas[] = '';
            $lineas[] = 'Sitemap: '.url('/sitemap.xml');
        } else {
            $lineas[] = 'Disallow: /';
        }

        return response(implode("\n", $lineas)."\n")
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
