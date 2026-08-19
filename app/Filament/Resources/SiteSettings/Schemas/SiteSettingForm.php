<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use App\Enums\MediaType;
use App\Filament\Support\MediaPicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('site_name')
                    ->label('Nombre del sitio')
                    ->required()
                    ->maxLength(80),

                TextInput::make('legal_name')
                    ->label('Razon social')
                    ->helperText('Nombre legal completo. Se usa en los datos estructurados que leen Google y los asistentes de IA.')
                    ->maxLength(120),

                MediaPicker::make('logo_header_media_id', 'logoHeaderMedia', MediaType::Image, 'logos')
                    ->label('Logo del header'),

                MediaPicker::make('logo_footer_media_id', 'logoFooterMedia', MediaType::Image, 'logos')
                    ->label('Logo del footer'),

                TextInput::make('logo_alt')
                    ->label('Texto alternativo del logo')
                    ->helperText('Si el archivo de la biblioteca ya tiene texto alternativo, se usa ese y este campo se ignora.')
                    ->maxLength(120),

                TextInput::make('email')
                    ->label('Correo de contacto')
                    ->email()
                    ->maxLength(120),

                TextInput::make('phone')
                    ->label('Telefono')
                    ->tel()
                    ->maxLength(40),

                TextInput::make('whatsapp')
                    ->label('WhatsApp')
                    ->helperText('Solo numeros con codigo de pais, sin espacios ni signos.')
                    ->maxLength(40),

                TextInput::make('address')
                    ->label('Direccion')
                    ->maxLength(255),

                TextInput::make('city')
                    ->label('Ciudad')
                    ->maxLength(80),

                TextInput::make('country')
                    ->label('Pais')
                    ->maxLength(80),

                TextInput::make('copyright')
                    ->label('Texto de copyright')
                    ->helperText('Escribi {year} donde quieras que aparezca el anio actual. Se actualiza solo.')
                    ->maxLength(160),
            ]);
    }
}
