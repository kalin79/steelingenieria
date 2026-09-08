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

    /**
     * Estructura que consume el componente Hero.vue.
     *
     * Es distinta de toPayload() a proposito: Hero ya existe, ya funciona
     * en catorce paginas y espera claves planas (image, imageM, boton).
     * Adaptar el backend al componente cuesta este metodo; adaptar el
     * componente al backend obligaria a tocar las catorce paginas y a
     * revisar cada una. Se elige lo primero.
     *
     * Dos detalles que no son cosmeticos:
     *
     * - link y boton salen como cadena vacia y nunca como null. Hero
     *   decide si dibuja el boton con `slide.link != ''`, y en JavaScript
     *   `null != ''` da true: con null el boton aparece igual, apuntando
     *   a ninguna parte.
     *
     * - imageM cae a la imagen de escritorio si no se cargo la version
     *   movil. Hero interpola `${slide.imageM}?format=webp`, asi que un
     *   null ahi genera la URL literal "null?format=webp" y la imagen
     *   queda rota en telefonos.
     */
    public function toHeroPayload(): array
    {
        $escritorio = $this->imageDesktopMedia?->url;
        $movil = $this->imageMobileMedia?->url;

        return [
            'id' => $this->id,
            'image' => $escritorio ?? $movil,
            'imageM' => $movil ?? $escritorio,
            'title' => $this->title,
            'subtitle' => $this->subtitle ?? '',
            'description' => $this->description ?? '',
            'boton' => $this->button_label ?? '',
            'link' => $this->link ?? '',
        ];
    }

    /**
     * Banners de una agrupacion listos para Hero.vue.
     *
     * Descarta los que no tienen ninguna imagen: un slide sin imagen se
     * ve como un bloque en blanco a pantalla completa, peor que no estar.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function paraHero(string $collection): array
    {
        return static::query()
            ->active($collection)
            ->get()
            ->filter(fn (self $banner) => filled($banner->imageDesktopMedia?->url)
                || filled($banner->imageMobileMedia?->url))
            ->map->toHeroPayload()
            ->values()
            ->all();
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
