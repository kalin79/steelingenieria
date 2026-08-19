<?php

namespace App\Models;

use App\Concerns\FlushesLayoutCache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialLink extends Model
{
    use FlushesLayoutCache;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'position' => 'integer',
        ];
    }

    public function iconMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'icon_media_id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('position');
    }

    /**
     * Devuelve siempre una URL absoluta, venga de la biblioteca o del
     * campo manual heredado. Que el formato sea uniforme importa: las
     * columnas de imagen del panel resuelven el origen del archivo a
     * partir de la forma de la ruta, y una ruta relativa las manda a
     * buscar el archivo al disco equivocado.
     */
    public function getIconUrlAttribute(): ?string
    {
        if ($this->iconMedia) {
            return $this->iconMedia->url;
        }

        return $this->icon ? url($this->icon) : null;
    }
}
