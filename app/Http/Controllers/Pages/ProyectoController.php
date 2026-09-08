<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Support\JsonLd;
use App\Support\Seo;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProyectoController extends Controller
{
    /** Listado publico: /proyectos */
    public function index(): Response
    {
        $proyectos = Project::query()->active()->get();

        $seo = Seo::make('Proyectos ejecutados')
            ->description('Obras de ingeniería, fabricación metalmecánica y montaje industrial ejecutadas para los sectores minero, logístico, manufacturero y alimentario en el Perú.')
            ->keywords('proyectos industriales, montaje industrial, fabricación metalmecánica, obras metalmecánicas Perú')
            ->canonical('/proyectos')
            ->schema(JsonLd::breadcrumb([
                ['name' => 'Inicio', 'url' => '/'],
                ['name' => 'Proyectos', 'url' => '/proyectos'],
            ]));

        return Inertia::render('Proyectos/Index', [
            'seo' => $seo->toArray(),
            'proyectos' => $proyectos->map->toCardPayload()->values(),
        ]);
    }

    /**
     * Detalle publico: /proyecto/{slug}
     *
     * El binding llega por slug porque Project::getRouteKeyName() lo
     * define asi. Se valida el estado a mano: un proyecto despublicado
     * existe en la base, y sin este control seguiria accesible para
     * cualquiera que tenga el enlace guardado o indexado.
     */
    public function show(Project $project): Response
    {
        if (! $project->is_active) {
            throw new NotFoundHttpException;
        }

        $project->load([
            'imageDesktopMedia',
            'imageMobileMedia',
            'bannerDesktopMedia',
            'bannerMobileMedia',
            'seoImageMedia',
        ]);

        $url = "/proyecto/{$project->slug}";

        $seo = Seo::make($project->seoTitle())
            ->description($project->seoDescription())
            ->keywords($project->seo_keywords)
            ->image($project->seoImageUrl())
            ->canonical($url)
            ->type('article')
            ->schema(JsonLd::project(
                nombre: $project->title,
                descripcion: $project->seoDescription(),
                imagen: $project->seoImageUrl() ? url($project->seoImageUrl()) : null,
                cliente: $project->client,
                ejecucion: $project->execution,
                url: url($url),
            ))
            ->schema(JsonLd::breadcrumb([
                ['name' => 'Inicio', 'url' => '/'],
                ['name' => 'Proyectos', 'url' => '/proyectos'],
                ['name' => $project->title, 'url' => $url],
            ]));

        return Inertia::render('Proyectos/Show', [
            'seo' => $seo->toArray(),
            'proyecto' => $project->toPayload(),
            // Otros proyectos para el bloque del final. Se excluye el
            // actual y se limita a 3: es sugerencia de navegacion, no un
            // segundo listado.
            'relacionados' => Project::query()
                ->active()
                ->whereKeyNot($project->id)
                ->limit(3)
                ->get()
                ->map->toCardPayload()
                ->values(),
        ]);
    }
}
