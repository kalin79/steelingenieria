<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum MediaType: string implements HasLabel
{
    case Image = 'image';
    case Document = 'document';
    case Video = 'video';

    public function getLabel(): string
    {
        return match ($this) {
            self::Image => 'Imagen',
            self::Document => 'Documento PDF',
            self::Video => 'Video MP4',
        };
    }

    /** Tipos MIME aceptados por cada categoria. */
    public function acceptedMimeTypes(): array
    {
        return match ($this) {
            self::Image => ['image/jpeg', 'image/png', 'image/webp', 'image/avif', 'image/svg+xml'],
            self::Document => ['application/pdf'],
            self::Video => ['video/mp4'],
        };
    }

    /** Tamano maximo en kilobytes. */
    public function maxSize(): int
    {
        return match ($this) {
            self::Image => 4096,      // 4 MB
            self::Document => 20480,  // 20 MB
            self::Video => 51200,     // 50 MB
        };
    }

    public function directory(): string
    {
        return match ($this) {
            self::Image => 'media/imagenes',
            self::Document => 'media/documentos',
            self::Video => 'media/videos',
        };
    }

    /** @return array<string, string> */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->getLabel()])
            ->all();
    }
}
