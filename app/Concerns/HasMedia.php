<?php

namespace App\Concerns;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Da a cualquier modelo la capacidad de tener archivos de la biblioteca
 * asociados, agrupados por coleccion.
 *
 * Uso tipico en un modelo Proyecto:
 *   $proyecto->mediaFrom('galeria')  -> archivos de la galeria
 *   $proyecto->firstMediaFrom('portada') -> la portada
 */
trait HasMedia
{
    public function media(): MorphToMany
    {
        return $this->morphToMany(Media::class, 'mediable')
            ->withPivot(['collection', 'position'])
            ->withTimestamps()
            ->orderByPivot('position');
    }

    public function mediaFrom(string $collection = 'default')
    {
        return $this->media->where('pivot.collection', $collection)->values();
    }

    public function firstMediaFrom(string $collection = 'default'): ?Media
    {
        return $this->mediaFrom($collection)->first();
    }

    /** Devuelve una coleccion lista para enviar a Vue. */
    public function mediaPayload(string $collection = 'default'): array
    {
        return $this->mediaFrom($collection)
            ->map(fn (Media $item) => $item->toPayload())
            ->all();
    }
}
