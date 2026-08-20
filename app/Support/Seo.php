<?php

namespace App\Support;

use App\Models\SiteSetting;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Metadatos de una pagina.
 *
 * Se arma en el controlador y viaja como prop de Inertia. La vista raiz
 * lo imprime del lado del servidor, asi los metadatos existen en el HTML
 * antes de que corra una sola linea de JavaScript.
 *
 * Uso:
 *   Seo::make('Montaje y mantenimiento metálico')
 *       ->description('Servicio de montaje...')
 *       ->image('/images/og/montaje.jpg')
 */
class Seo implements Arrayable
{
    private string $title;

    private ?string $description = null;

    private ?string $image = null;

    private ?string $canonical = null;

    private bool $indexable = true;

    private string $type = 'website';

    /** @var array<int, array<string, mixed>> */
    private array $schemas = [];

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public static function make(string $title): self
    {
        return new self($title);
    }

    public function description(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function image(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function canonical(?string $canonical): self
    {
        $this->canonical = $canonical;

        return $this;
    }

    /** Paginas de resultados, filtros o contenido duplicado. */
    public function noIndex(): self
    {
        $this->indexable = false;

        return $this;
    }

    public function type(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /** Agrega un bloque de datos estructurados especifico de la pagina. */
    public function schema(array $schema): self
    {
        $this->schemas[] = $schema;

        return $this;
    }

    public function toArray(): array
    {
        $settings = SiteSetting::current();
        $siteName = $settings->site_name ?: config('app.name');

        return [
            // El titulo completo incluye la marca: es lo que se ve en la
            // pestaña y en el resultado de busqueda.
            'title' => "{$this->title} | {$siteName}",
            'rawTitle' => $this->title,
            'description' => $this->description,
            'image' => $this->image ? url($this->image) : null,
            // Sin canonical explicito se usa la URL actual sin parametros,
            // que evita que ?utm_source cree duplicados en el indice.
            'canonical' => $this->canonical ?: url()->current(),
            'robots' => $this->indexable ? 'index, follow' : 'noindex, follow',
            'type' => $this->type,
            'siteName' => $siteName,
            'locale' => 'es_PE',
            'schemas' => $this->schemas,
        ];
    }
}
