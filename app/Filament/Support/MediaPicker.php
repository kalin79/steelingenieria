<?php

namespace App\Filament\Support;

use App\Enums\MediaType;
use App\Models\Media;
use App\Services\MediaService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\HtmlString;

/**
 * Selector de biblioteca reutilizable.
 *
 * Un solo control resuelve los dos casos: buscar un archivo que ya esta
 * cargado, o subir uno nuevo desde un modal sin abandonar el formulario.
 * El archivo nuevo queda registrado en la biblioteca, disponible para
 * cualquier otro modulo, en vez de vivir aislado en este campo.
 *
 * Uso:
 *   MediaPicker::make('logo_header_media_id', 'logoHeaderMedia', MediaType::Image, 'logos')
 *       ->label('Logo del header')
 */
class MediaPicker
{
    /**
     * @param  string  $field  Columna de la base que guarda el id.
     * @param  string  $relationship  Nombre del metodo de relacion en el modelo.
     * @param  MediaType  $type  Unico filtro duro: no se puede elegir un PDF donde va una imagen.
     * @param  string|null  $defaultCollection  Etiqueta que se asigna al archivo si se sube
     *                                          desde este campo. NO filtra el listado: la
     *                                          agrupacion sirve para organizar la biblioteca,
     *                                          no para limitar que podes elegir.
     * @param  bool  $restrictToCollection  Activar solo si de verdad querés que este campo
     *                                      muestre unicamente los archivos de esa agrupacion.
     */
    public static function make(
        string $field,
        string $relationship,
        MediaType $type = MediaType::Image,
        ?string $defaultCollection = null,
        bool $restrictToCollection = false,
    ): Select {
        return Select::make($field)
            ->label('Archivo de la biblioteca')
            ->helperText('Busca por titulo o por nombre de archivo. Si todavia no esta cargado, usa el boton de mas para subirlo sin salir de esta pantalla.')
            ->relationship(
                name: $relationship,
                titleAttribute: 'title',
                modifyQueryUsing: fn ($query) => $query
                    ->where('type', $type)
                    ->when(
                        $restrictToCollection && $defaultCollection,
                        fn ($q) => $q->where('collection', $defaultCollection)
                    )
                    ->orderByDesc('id'),
            )
            // Renderiza miniatura y metadatos en cada opcion, y tambien en
            // el valor ya seleccionado. Sin esto solo se ve un nombre y hay
            // que abrir la biblioteca en otra pestana para saber cual es.
            ->allowHtml()
            ->getOptionLabelFromRecordUsing(
                fn (Media $record) => self::optionLabel($record)
            )
            ->searchable(['title', 'original_name'])
            ->preload()
            ->createOptionForm(self::quickUploadFields($type, $defaultCollection))
            ->createOptionModalHeading('Subir a la biblioteca');
    }

    /**
     * Etiqueta enriquecida de cada opcion.
     *
     * Se usan estilos en linea a proposito: el markup viaja dentro del
     * componente de seleccion, fuera del arbol donde aplican las clases
     * del panel, asi que las utilidades de Tailwind no llegan.
     *
     * Todo texto que venga de la base pasa por e(): allowHtml desactiva
     * el escapado automatico, y un titulo cargado por un editor no es
     * contenido en el que se pueda confiar a ciegas.
     */
    private static function optionLabel(Media $record): HtmlString
    {
        $titulo = e($record->title ?: $record->original_name);

        $meta = $record->width && $record->height
            ? "{$record->width} x {$record->height} · {$record->human_size}"
            : $record->human_size;

        $miniatura = self::thumbnail($record);

        return new HtmlString(
            '<div style="display:flex;align-items:center;gap:0.65rem;min-width:0;">'
                .$miniatura
                .'<span style="display:flex;flex-direction:column;line-height:1.25;min-width:0;">'
                    .'<span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">'.$titulo.'</span>'
                    .'<span style="font-size:0.75rem;opacity:0.6;">'.e($meta).'</span>'
                .'</span>'
            .'</div>'
        );
    }

    /** Miniatura para imagenes, portada para videos, etiqueta para documentos. */
    private static function thumbnail(Media $record): string
    {
        $base = 'width:34px;height:34px;flex:0 0 34px;border-radius:5px;background:#f3f4f6;';

        $url = match (true) {
            $record->type === MediaType::Image => $record->url,
            $record->type === MediaType::Video => $record->poster?->url,
            default => null,
        };

        if ($url) {
            return '<img src="'.e($url).'" alt="" loading="lazy" style="'.$base.'object-fit:contain;" />';
        }

        $etiqueta = $record->type === MediaType::Document ? 'PDF' : 'MP4';

        return '<span style="'.$base.'display:inline-flex;align-items:center;justify-content:center;'
            .'font-size:0.65rem;font-weight:600;opacity:0.6;">'.$etiqueta.'</span>';
    }

    /**
     * Campos minimos para dar de alta un archivo desde el modal. El resto
     * de los metadatos tecnicos los completa el observer leyendo el
     * archivo real, asi que no hace falta pedirlos aca.
     *
     * @return array<int, mixed>
     */
    public static function quickUploadFields(MediaType $type, ?string $collection = null): array
    {
        return [
            Hidden::make('type')
                ->default($type->value),

            Hidden::make('collection')
                ->default($collection),

            FileUpload::make('path')
                ->label('Archivo')
                ->required()
                ->disk('public')
                ->visibility('public')
                ->directory($type->directory())
                ->acceptedFileTypes($type->acceptedMimeTypes())
                ->maxSize($type->maxSize())
                ->getUploadedFileNameForStorageUsing(
                    fn ($file) => app(MediaService::class)->storageName($file)
                ),

            TextInput::make('title')
                ->label('Titulo')
                ->helperText('Con este nombre vas a encontrarlo despues en la biblioteca.')
                ->required()
                ->maxLength(120),

            TextInput::make('alt')
                ->label('Texto alternativo')
                ->helperText('Describi lo que se ve. Obligatorio en imagenes por accesibilidad y posicionamiento.')
                ->required(fn () => $type === MediaType::Image)
                ->maxLength(160),
        ];
    }

    /** Titulo legible para mostrar en listados. */
    public static function titleFor(?Media $media): string
    {
        return $media?->title ?: ($media?->original_name ?? '—');
    }
}
