<?php

namespace App\Services;

use App\Enums\MediaType;
use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaService
{
    /**
     * Registra un archivo en la biblioteca desde codigo (seeders,
     * comandos, importaciones). Filament sube por su cuenta y solo
     * persiste el path; el observer completa el resto.
     */
    public function store(
        UploadedFile $file,
        MediaType $type,
        ?string $collection = null,
        array $attributes = [],
        string $disk = 'public',
    ): Media {
        $name = $this->storageName($file);

        $path = $file->storeAs($type->directory(), $name, ['disk' => $disk]);

        return Media::query()->create([
            'type' => $type,
            'collection' => $collection,
            'disk' => $disk,
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
            ...$attributes,
        ]);
    }

    /**
     * Nombre de archivo legible y estable. Se usa el nombre original en
     * formato slug en vez de un hash: el nombre del archivo es una senal
     * de posicionamiento en busqueda de imagenes y en PDFs indexados.
     * El sufijo corto evita colisiones sin volver el nombre ilegible.
     */
    public function storageName(UploadedFile $file): string
    {
        $base = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $base = Str::limit($base ?: 'archivo', 60, '');
        $extension = Str::lower($file->getClientOriginalExtension());

        return $base.'-'.Str::lower(Str::random(6)).'.'.$extension;
    }

    /** Elimina registros cuyo archivo fisico ya no existe en el disco. */
    public function pruneOrphans(): int
    {
        $removed = 0;

        Media::query()->chunkById(100, function ($items) use (&$removed) {
            foreach ($items as $media) {
                if (! Storage::disk($media->disk)->exists($media->path)) {
                    $media->delete();
                    $removed++;
                }
            }
        });

        return $removed;
    }
}
