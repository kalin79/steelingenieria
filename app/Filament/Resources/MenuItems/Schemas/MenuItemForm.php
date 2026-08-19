<?php

namespace App\Filament\Resources\MenuItems\Schemas;

use App\Enums\LinkTarget;
use App\Models\MenuItem;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MenuItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('menu_id')
                    ->label('Menu')
                    ->relationship('menu', 'name')
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn ($set) => $set('parent_id', null)),

                Select::make('parent_id')
                    ->label('Depende de')
                    ->helperText('Dejar vacio para que sea un item de primer nivel.')
                    ->placeholder('Primer nivel')
                    ->options(function ($get, $record) {
                        $menuId = $get('menu_id');

                        if (blank($menuId)) {
                            return [];
                        }

                        return MenuItem::query()
                            ->where('menu_id', $menuId)
                            ->whereNull('parent_id')
                            // Un item nunca puede ser padre de si mismo:
                            // eso genera un ciclo y cuelga el render del menu.
                            ->when($record, fn ($query) => $query->whereKeyNot($record->getKey()))
                            ->orderBy('position')
                            ->pluck('label', 'id')
                            ->all();
                    })
                    ->searchable(),

                TextInput::make('label')
                    ->label('Texto visible')
                    ->helperText('Lo que ve el usuario. Conviene que sea corto y descriptivo.')
                    ->required()
                    ->maxLength(60),

                TextInput::make('url')
                    ->label('Enlace')
                    ->helperText('Ruta interna como /servicios, o URL completa para enlaces externos.')
                    ->required()
                    ->maxLength(255)
                    ->default('/'),

                Select::make('target')
                    ->label('Abrir en')
                    ->options(LinkTarget::class)
                    ->default(LinkTarget::Self->value)
                    ->required(),

                TextInput::make('position')
                    ->label('Orden')
                    ->helperText('Tambien se puede ordenar arrastrando desde el listado.')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),

                Toggle::make('is_active')
                    ->label('Visible en el sitio')
                    ->default(true),
            ]);
    }
}
