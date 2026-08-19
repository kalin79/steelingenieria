<?php

namespace App\Filament\Resources\Menus\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->helperText('Nombre interno del menu. Tambien se usa como titulo de la columna en el footer.')
                    ->required()
                    ->maxLength(80)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, $set, $get) {
                        // Solo autocompleta si el slug todavia esta vacio, para no
                        // pisar el slug de un menu que ya esta en uso en el sitio.
                        if (blank($get('slug'))) {
                            $set('slug', Str::slug((string) $state));
                        }
                    }),

                TextInput::make('slug')
                    ->label('Identificador')
                    ->helperText('Se usa en el codigo para invocar el menu. Cambiarlo puede dejar de mostrar el menu en el sitio.')
                    ->required()
                    ->maxLength(80)
                    ->alphaDash()
                    ->unique(ignoreRecord: true),

                TextInput::make('description')
                    ->label('Descripcion')
                    ->helperText('Nota interna. No se muestra en el sitio.')
                    ->maxLength(160),
            ]);
    }
}
