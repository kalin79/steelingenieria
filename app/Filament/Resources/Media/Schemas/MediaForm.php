<?php

namespace App\Filament\Resources\Media\Schemas;

use App\Enums\MediaType;
use App\Models\Media;
use App\Services\MediaService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->label('Tipo de archivo')
                    ->helperText('Definilo primero: condiciona que formatos se aceptan y el peso maximo.')
                    ->options(MediaType::class)
                    ->default(MediaType::Image->value)
                    ->required()
                    ->live()
                    ->disabledOn('edit'),

                FileUpload::make('path')
                    ->label('Archivo')
                    ->required()
                    ->disk('public')
                    ->visibility('public')
                    ->directory(fn($get) => self::type($get)->directory())
                    ->acceptedFileTypes(fn($get) => self::type($get)->acceptedMimeTypes())
                    ->maxSize(fn($get) => self::type($get)->maxSize())
                    // Nombre legible en vez de hash: el nombre del archivo
                    // es senal de posicionamiento en busqueda de imagenes.
                    ->getUploadedFileNameForStorageUsing(
                        fn($file) => app(MediaService::class)->storageName($file)
                    )
                    ->helperText(fn($get) => match (self::type($get)) {
                        MediaType::Image => 'JPG, PNG, WebP, AVIF o SVG. Maximo 4 MB. Preferi WebP: pesa entre 25 y 35 por ciento menos que un JPG equivalente.',
                        MediaType::Document => 'Solo PDF. Maximo 20 MB. El nombre del archivo se indexa en Google, ponele un nombre descriptivo antes de subirlo.',
                        MediaType::Video => 'Solo MP4. Maximo 50 MB. Para videos mas pesados conviene un hosting externo: servirlos desde el mismo servidor consume ancho de banda y degrada el tiempo de respuesta del sitio.',
                    }),

                TextInput::make('original_name')
                    ->label('Nombre original')
                    ->disabled()
                    ->dehydrated(false)
                    ->visibleOn('edit'),

                TextInput::make('title')
                    ->label('Titulo')
                    ->helperText('Nombre con el que vas a encontrar el archivo en la biblioteca.')
                    ->maxLength(120),

                TextInput::make('alt')
                    ->label('Texto alternativo')
                    ->helperText('Describi lo que se ve, no repitas el nombre del archivo. Es lo que lee un lector de pantalla, lo que indexa la busqueda de imagenes y una de las senales que usan los asistentes de IA para entender el contenido.')
                    ->maxLength(160)
                    ->required(fn($get) => self::type($get) === MediaType::Image)
                    ->visible(fn($get) => self::type($get) === MediaType::Image),

                Textarea::make('caption')
                    ->label('Descripcion')
                    ->helperText('Opcional. Se puede mostrar como pie de imagen o descripcion del documento.')
                    ->rows(3),

                TextInput::make('collection')
                    ->label('Agrupacion')
                    ->helperText('Etiqueta libre para filtrar: banners, proyectos, fichas-tecnicas, certificados.')
                    ->maxLength(60),

                Select::make('poster_id')
                    ->label('Imagen de portada')
                    ->helperText('Obligatoria en la practica: sin portada el navegador descarga los primeros fotogramas del video solo para mostrar algo, y eso golpea directo el tiempo de carga.')
                    ->options(fn() => Media::query()
                        ->where('type', MediaType::Image)
                        ->orderByDesc('id')
                        ->limit(100)
                        ->pluck('title', 'id')
                        ->all())
                    ->searchable()
                    ->visible(fn($get) => self::type($get) === MediaType::Video),

                TextInput::make('duration')
                    ->label('Duracion en segundos')
                    ->helperText('Opcional. Se usa para los datos estructurados de video.')
                    ->numeric()
                    ->minValue(0)
                    ->visible(fn($get) => self::type($get) === MediaType::Video),
            ]);
    }

    private static function type($get): MediaType
    {
        $value = $get('type');

        if ($value instanceof MediaType) {
            return $value;
        }

        return MediaType::tryFrom((string) $value) ?? MediaType::Image;
    }
}
