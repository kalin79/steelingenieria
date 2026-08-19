<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Banner extends Model
{
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

    public function imageDesktopMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_desktop_media_id');
    }

    public function imageMobileMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_mobile_media_id');
    }

    /** Banners visibles de una agrupacion, ya ordenados. */
    public function scopeActive(Builder $query, ?string $collection = null): Builder
    {
        return $query
            ->where('is_active', true)
            ->when($collection, fn ($q) => $q->where('collection', $collection))
            ->with(['iconMedia', 'imageDesktopMedia', 'imageMobileMedia'])
            ->orderBy('position');
    }

    /**
     * Estructura lista para Vue.
     *
     * Se envian las dimensiones de cada imagen porque el banner suele ser
     * el elemento mas grande de la pantalla inicial: sin ellas el bloque
     * arranca en altura cero y empuja todo el contenido al cargar.
     */
    public function toPayload(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'link' => $this->link,
            'buttonLabel' => $this->button_label,
            'icon' => $this->iconMedia ? [
                'url' => $this->iconMedia->url,
                'alt' => $this->iconMedia->alt ?? '',
            ] : null,
            'iconDescription' => $this->icon_description,
            'imageDesktop' => $this->mediaPayload($this->imageDesktopMedia),
            'imageMobile' => $this->mediaPayload($this->imageMobileMedia),
        ];
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
