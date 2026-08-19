<?php

namespace App\Filament\Resources\Banners\Schemas;

use App\Enums\MediaType;
use App\Filament\Support\MediaPicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Titulo')
                    ->helperText('Es el texto mas grande del banner. Si esta pagina no tiene otro encabezado principal, este es el que va a leer Google como titulo de la seccion.')
                    ->required()
                    ->maxLength(120),

                TextInput::make('subtitle')
                    ->label('Subtitulo')
                    ->maxLength(160),

                Textarea::make('description')
                    ->label('Descripcion')
                    ->rows(3)
                    ->maxLength(400),

                TextInput::make('link')
                    ->label('Enlace del boton')
                    ->helperText('Ruta interna como /contactenos, o URL completa para destinos externos. Dejalo vacio si el banner no lleva boton.')
                    ->maxLength(255)
                    ->live(onBlur: true),

                TextInput::make('button_label')
                    ->label('Texto del boton')
                    ->helperText('Deci que pasa al hacer clic. "Solicita una cotizacion" convierte mas que "Ver mas", y ademas le dice al buscador de que trata el destino.')
                    ->maxLength(60)
                    // Un enlace sin texto de boton no se puede renderizar:
                    // quedaria un boton vacio o un enlace invisible.
                    ->required(fn ($get) => filled($get('link'))),

                MediaPicker::make('icon_media_id', 'iconMedia', MediaType::Image, 'iconos')
                    ->label('Icono'),

                TextInput::make('icon_description')
                    ->label('Descripcion del icono')
                    ->helperText('Texto que acompana al icono dentro del banner.')
                    ->maxLength(160),

                MediaPicker::make('image_desktop_media_id', 'imageDesktopMedia', MediaType::Image, 'banners')
                    ->label('Imagen para escritorio')
                    ->helperText('Medida recomendada: 1920 x 1080 px, formato WebP, hasta 300 KB. Es una imagen a pantalla completa, asi que dejá el sujeto principal centrado: los bordes se recortan segun la proporcion de cada monitor.'),

                MediaPicker::make('image_mobile_media_id', 'imageMobileMedia', MediaType::Image, 'banners')
                    ->label('Imagen para movil')
                    ->helperText('Medida recomendada: 1080 x 1920 px (vertical), formato WebP, hasta 200 KB. Usa una toma vertical, no la misma de escritorio: una imagen apaisada recortada en un telefono deja el sujeto fuera de cuadro.'),

                TextInput::make('collection')
                    ->label('Agrupacion')
                    ->helperText('Etiqueta libre para indicar donde va: home, servicios, master-mover. Los banners se piden al sitio por esta etiqueta.')
                    ->maxLength(60),

                TextInput::make('position')
                    ->label('Orden')
                    ->helperText('Define el orden dentro de la agrupacion. Tambien se puede ordenar arrastrando desde el listado.')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),

                Toggle::make('is_active')
                    ->label('Visible en el sitio')
                    ->default(true),
            ]);
    }
}
