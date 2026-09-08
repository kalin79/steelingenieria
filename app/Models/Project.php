<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'position' => 'integer',
        ];
    }

    /**
     * Las URLs publicas usan el slug, no el id.
     *
     * Con esto, Route::get('/proyecto/{project}') resuelve por slug sin
     * tener que escribir {project:slug} en cada ruta.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        /*
         * Red de seguridad del slug.
         *
         * El panel ya lo genera al escribir el titulo, pero un registro
         * creado por seeder, import o tinker no pasa por el formulario.
         * Aca se garantiza que ningun proyecto quede sin slug.
         *
         * Solo se completa si viene vacio: NO se regenera al editar el
         * titulo de un proyecto ya publicado. Cambiar el slug rompe el
         * enlace que ya esta indexado en Google y compartido en correos,
         * y devuelve 404 a quien lo tenia guardado. Si de verdad hace
         * falta cambiarlo, se edita a mano y se decide que hacer con la
         * URL vieja.
         */
        static::saving(function (self $project) {
            if (blank($project->slug)) {
                $project->slug = static::slugUnico($project->title, $project->id);
            }
        });
    }

    /**
     * Slug derivado del titulo, garantizado unico.
     *
     * Si "Montaje de faja transportadora" ya existe, el siguiente queda
     * como "montaje-de-faja-transportadora-2".
     *
     * @param  int|null  $ignorarId  Id del propio registro al editar, para
     *                               que no se choque consigo mismo.
     */
    public static function slugUnico(?string $titulo, ?int $ignorarId = null): string
    {
        $base = Str::slug((string) $titulo) ?: 'proyecto';
        $slug = $base;
        $intento = 2;

        while (
            static::query()
                ->where('slug', $slug)
                ->when($ignorarId, fn (Builder $q) => $q->whereKeyNot($ignorarId))
                ->exists()
        ) {
            $slug = "{$base}-{$intento}";
            $intento++;
        }

        return $slug;
    }

    public function imageDesktopMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_desktop_media_id');
    }

    public function imageMobileMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_mobile_media_id');
    }

    public function bannerDesktopMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'banner_desktop_media_id');
    }

    public function bannerMobileMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'banner_mobile_media_id');
    }

    public function seoImageMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'seo_image_media_id');
    }

    /**
     * Proyectos visibles, ordenados, con las imagenes de tarjeta ya
     * cargadas. Sin el with() el listado dispara dos consultas por cada
     * proyecto que renderiza.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->where('is_active', true)
            ->with(['imageDesktopMedia', 'imageMobileMedia'])
            ->orderBy('position')
            ->orderByDesc('id');
    }

    /**
     * Ultimos proyectos ingresados, listos para el carrusel del home.
     *
     * Ordena por id descendente y no por 'position': "ultimos ingresados"
     * es orden de alta, y position es el orden manual del listado. Son dos
     * criterios distintos a proposito, asi el equipo puede reordenar
     * /proyectos sin que se le mueva lo que sale en la portada.
     *
     * Devuelve un array plano para pasarlo directo como prop de Inertia.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function ultimos(int $limite = 5): array
    {
        return static::query()
            ->where('is_active', true)
            ->with(['imageDesktopMedia', 'imageMobileMedia'])
            ->orderByDesc('id')
            ->limit($limite)
            ->get()
            ->map
            ->toCardPayload()
            ->values()
            ->all();
    }

    /** Datos minimos para la tarjeta del listado y del carrusel del home. */
    public function toCardPayload(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'subtitle' => $this->subtitle,
            'client' => $this->client,
            'execution' => $this->execution,
            'url' => "/proyecto/{$this->slug}",
            'imageDesktop' => $this->mediaPayload($this->imageDesktopMedia),
            'imageMobile' => $this->mediaPayload($this->imageMobileMedia),
        ];
    }

    /** Datos completos del detalle. */
    public function toPayload(): array
    {
        return [
            ...$this->toCardPayload(),
            // HTML del editor enriquecido: se pinta con v-html en el
            // detalle. Es contenido cargado por el equipo desde el panel,
            // no por un visitante.
            'description' => $this->description,
            'bannerDesktop' => $this->mediaPayload($this->bannerDesktopMedia),
            'bannerMobile' => $this->mediaPayload($this->bannerMobileMedia),
        ];
    }

    /** Titulo para la etiqueta <title>: usa el de SEO si se cargo. */
    public function seoTitle(): string
    {
        return $this->seo_title ?: $this->title;
    }

    /**
     * Descripcion para el buscador.
     *
     * Si no se cargo una propia, se arma desde la descripcion enriquecida:
     * se le quita el HTML y se corta a 160 caracteres, que es lo que
     * Google alcanza a mostrar. Mejor eso que dejarla vacia.
     */
    public function seoDescription(): ?string
    {
        if (filled($this->seo_description)) {
            return $this->seo_description;
        }

        if (blank($this->description)) {
            return $this->subtitle;
        }

        return Str::limit(trim(strip_tags($this->description)), 157);
    }

    /** Imagen para compartir. Cae al banner de escritorio si no hay propia. */
    public function seoImageUrl(): ?string
    {
        return $this->seoImageMedia?->url
            ?? $this->bannerDesktopMedia?->url
            ?? $this->imageDesktopMedia?->url;
    }

    private function mediaPayload(?Media $media): ?array
    {
        if (! $media) {
            return null;
        }

        return [
            'url' => $media->url,
            'alt' => $media->alt ?? '',
            'width' => $media->width,
            'height' => $media->height,
            'aspectRatio' => $media->aspect_ratio,
        ];
    }
}
