<?php

namespace App\Filament\Resources\SocialLinks\Schemas;

use App\Enums\MediaType;
use App\Filament\Support\MediaPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SocialLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('platform')
                    ->label('Red social')
                    ->helperText('LinkedIn, Facebook, Instagram, YouTube.')
                    ->required()
                    ->maxLength(40),

                TextInput::make('url')
                    ->label('Enlace al perfil')
                    ->helperText('URL completa, empezando por https://')
                    ->required()
                    ->url()
                    ->maxLength(255),

                MediaPicker::make('icon_media_id', 'iconMedia', MediaType::Image, 'iconos')
                    ->label('Icono'),

                TextInput::make('label')
                    ->label('Texto alternativo')
                    ->helperText('Se usa como aria-label del enlace. Obligatorio para accesibilidad: sin esto un lector de pantalla solo anuncia un enlace sin nombre.')
                    ->required()
                    ->maxLength(80),

                TextInput::make('position')
                    ->label('Orden')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),

                Toggle::make('is_active')
                    ->label('Visible en el sitio')
                    ->default(true),
            ]);
    }
}
