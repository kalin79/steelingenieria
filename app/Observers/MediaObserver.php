<?php

namespace App\Observers;

use App\Enums\MediaType;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

/**
 * Completa los metadatos tecnicos leyendo el archivo real, en vez de
 * confiar en lo que declare el formulario. Se ejecuta tanto si el
 * archivo llega desde Filament como desde un seeder o un comando.
 */
class MediaObserver
{
    public function saving(Media $media): void
    {
        if (blank($media->path) || ! $media->isDirty('path')) {
            return;
        }

        $disk = Storage::disk($media->disk ?: 'public');

        if (! $disk->exists($media->path)) {
            return;
        }

        $media->size = $disk->size($media->path);
        $media->mime_type = $disk->mimeType($media->path) ?: null;
        $media->extension = pathinfo($media->path, PATHINFO_EXTENSION) ?: null;

        if (blank($media->original_name)) {
            $media->original_name = basename($media->path);
        }

        // Solo las imagenes rasterizadas exponen dimensiones por getimagesize.
        // Los SVG no, y es correcto que queden en null.
        if ($media->type === MediaType::Image) {
            $this->extractDimensions($media, $disk->path($media->path));
        }
    }

    public function deleting(Media $media): void
    {
        // Se borra el archivo fisico junto con el registro para que el
        // disco no acumule huerfanos invisibles desde el panel.
        $disk = Storage::disk($media->disk ?: 'public');

        if (filled($media->path) && $disk->exists($media->path)) {
            $disk->delete($media->path);
        }
    }

    private function extractDimensions(Media $media, string $absolutePath): void
    {
        if (! is_readable($absolutePath)) {
            return;
        }

        $info = @getimagesize($absolutePath);

        if ($info === false) {
            return;
        }

        $media->width = $info[0] ?? null;
        $media->height = $info[1] ?? null;
    }
}
