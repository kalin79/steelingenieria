<?php

namespace App\Concerns;

use App\Services\LayoutService;

/**
 * Invalida el cache del layout cuando cambia cualquier modelo que lo
 * compone. Sin esto, un cambio hecho desde Filament no se veria en el
 * sitio hasta que expire el cache.
 */
trait FlushesLayoutCache
{
    protected static function bootFlushesLayoutCache(): void
    {
        static::saved(fn () => app(LayoutService::class)->flush());
        static::deleted(fn () => app(LayoutService::class)->flush());
    }
}
