<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Enums\MediaType;
use App\Filament\Support\MediaPicker;
use App\Models\Project;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contenido')
                    ->description('Lo que ve el visitante en la ficha del proyecto.')
                    ->schema([
                        TextInput::make('title')
                            ->label('Titulo')
                            ->helperText('Nombre del proyecto. Al escribirlo se arma solo la direccion web de abajo.')
                            ->required()
                            ->maxLength(160)
                            ->live(onBlur: true)
                            // El slug se propone solo mientras el proyecto
                            // es nuevo. En edicion no se toca: cambiarlo
                            // rompe el enlace ya indexado y compartido.
                            ->afterStateUpdated(function ($state, $get, $set, ?Project $record) {
                                if ($record !== null || filled($get('slug'))) {
                                    return;
                                }

                                $set('slug', Str::slug((string) $state));
                            }),

                        TextInput::make('slug')
                            ->label('Direccion web')
                            ->prefix('/proyecto/')
                            ->helperText('Se genera desde el titulo. Cambiala solo antes de publicar: una vez que el enlace circula, modificarla deja en 404 a quien lo tenia guardado y borra lo que Google ya indexo.')
                            ->required()
                            ->maxLength(180)
                            ->unique(ignoreRecord: true)
                            ->rules(['alpha_dash'])
                            ->dehydrateStateUsing(fn (?string $state) => Str::slug((string) $state)),

                        TextInput::make('subtitle')
                            ->label('Subtitulo')
                            ->helperText('Una linea que resuma el alcance. Se muestra bajo el titulo en la ficha.')
                            ->maxLength(200),

                        RichEditor::make('description')
                            ->label('Descripcion')
                            ->helperText('Contenido completo del proyecto. Usa subtitulos y listas: un bloque de texto corrido no lo lee nadie ni en pantalla ni en el buscador.')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike',
                                'h2', 'h3',
                                'bulletList', 'orderedList',
                                'link', 'blockquote',
                                'undo', 'redo',
                            ])
                            ->columnSpanFull(),
                    ]),

                Section::make('Ficha tecnica')
                    ->description('Datos que acompanan al proyecto.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('client')
                            ->label('Cliente')
                            ->maxLength(160),

                        TextInput::make('execution')
                            ->label('Ejecucion')
                            ->helperText('Texto libre: "Marzo 2024", "6 meses", "2023 - 2024".')
                            ->maxLength(120),
                    ]),

                Section::make('Imagenes de la tarjeta')
                    ->description('Las que se ven en el listado de /proyectos y en el carrusel del inicio.')
                    ->schema([
                        MediaPicker::make('image_desktop_media_id', 'imageDesktopMedia', MediaType::Image, 'proyectos')
                            ->label('Imagen para escritorio')
                            ->helperText('Medida recomendada: 1200 x 800 px, formato WebP, hasta 250 KB.'),

                        MediaPicker::make('image_mobile_media_id', 'imageMobileMedia', MediaType::Image, 'proyectos')
                            ->label('Imagen para movil')
                            ->helperText('Medida recomendada: 800 x 800 px, formato WebP, hasta 150 KB. Si la dejas vacia se usa la de escritorio.'),
                    ]),

                Section::make('Imagenes de cabecera')
                    ->description('Banner superior dentro de la ficha del proyecto.')
                    ->schema([
                        MediaPicker::make('banner_desktop_media_id', 'bannerDesktopMedia', MediaType::Image, 'proyectos')
                            ->label('Banner para escritorio')
                            ->helperText('Medida recomendada: 1920 x 800 px, formato WebP, hasta 300 KB. Deja el sujeto centrado: los bordes se recortan segun el monitor.'),

                        MediaPicker::make('banner_mobile_media_id', 'bannerMobileMedia', MediaType::Image, 'proyectos')
                            ->label('Banner para movil')
                            ->helperText('Medida recomendada: 1080 x 1200 px, formato WebP, hasta 200 KB. Usa una toma mas vertical, no la misma de escritorio.'),
                    ]),

                Section::make('Posicionamiento')
                    ->description('Como aparece este proyecto en Google y al compartirlo por WhatsApp o LinkedIn.')
                    ->collapsed()
                    ->schema([
                        TextInput::make('seo_title')
                            ->label('Titulo para buscadores')
                            ->helperText('Hasta 60 caracteres. Si lo dejas vacio se usa el titulo del proyecto. Escribi el termino que la gente busca, no el nombre interno de la obra.')
                            ->maxLength(70),

                        TextInput::make('seo_keywords')
                            ->label('Palabras clave')
                            ->helperText('Separadas por coma. Google las ignora desde hace anos como factor de posicion: sirven para dejar registrado a que termino apunta esta ficha y para guiar el texto que escribis arriba.')
                            ->maxLength(255),

                        Textarea::make('seo_description')
                            ->label('Descripcion para buscadores')
                            ->helperText('Entre 120 y 160 caracteres. Es el texto gris del resultado de busqueda: decide el clic. Si la dejas vacia se arma sola con el inicio de la descripcion.')
                            ->rows(3)
                            ->maxLength(320),

                        MediaPicker::make('seo_image_media_id', 'seoImageMedia', MediaType::Image, 'proyectos')
                            ->label('Imagen para compartir')
                            ->helperText('Medida exacta: 1200 x 630 px. Es la que aparece en la tarjeta de WhatsApp y LinkedIn. Si la dejas vacia se usa el banner de escritorio.'),
                    ]),

                Section::make('Publicacion')
                    ->columns(2)
                    ->schema([
                        TextInput::make('position')
                            ->label('Orden')
                            ->helperText('Menor numero, mas arriba. Tambien podes ordenar arrastrando desde el listado.')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),

                        Toggle::make('is_active')
                            ->label('Visible en el sitio')
                            ->helperText('Apagalo para sacarlo del listado sin borrar el contenido.')
                            ->default(true),
                    ]),
            ]);
    }
}
