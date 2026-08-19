<?php

namespace App\Filament\Resources\FooterBlocks\Schemas;

use App\Enums\BlockWidth;
use App\Enums\FooterBlockType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FooterBlockForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->label('Tipo de bloque')
                    ->options(FooterBlockType::class)
                    ->required()
                    ->live(),

                TextInput::make('title')
                    ->label('Titulo de la columna')
                    ->helperText('Por ejemplo: Mapa de sitio, Servicios, Politicas.')
                    ->maxLength(60)
                    ->visible(fn ($get) => in_array(self::typeOf($get), [
                        FooterBlockType::Menu,
                        FooterBlockType::Text,
                        FooterBlockType::Social,
                    ], true)),

                Select::make('menu_id')
                    ->label('Menu a mostrar')
                    ->helperText('El bloque no guarda enlaces: apunta a un menu. Si cambias ese menu, el cambio se refleja en todos los lugares donde se muestre.')
                    ->relationship('menu', 'name')
                    ->searchable()
                    ->preload()
                    ->required(fn ($get) => self::typeOf($get) === FooterBlockType::Menu)
                    ->visible(fn ($get) => self::typeOf($get) === FooterBlockType::Menu),

                Textarea::make('content')
                    ->label('Contenido')
                    ->rows(4)
                    ->required(fn ($get) => self::typeOf($get) === FooterBlockType::Text)
                    ->visible(fn ($get) => self::typeOf($get) === FooterBlockType::Text),

                Select::make('width')
                    ->label('Ancho')
                    ->helperText('Columna ocupa parte de la fila. Fila completa ocupa todo el ancho del footer.')
                    ->options(BlockWidth::class)
                    ->default(BlockWidth::Column->value)
                    ->required()
                    ->live(),

                Select::make('column_span')
                    ->label('Columnas que ocupa')
                    ->helperText('Sobre una grilla de 12. Cuatro bloques de 3 completan una fila exacta.')
                    ->options(array_combine(range(1, 12), range(1, 12)))
                    ->default(3)
                    ->required()
                    ->visible(fn ($get) => self::widthOf($get) === BlockWidth::Column),

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

    /**
     * Normaliza el valor del campo antes de compararlo.
     *
     * Al crear un registro el formulario maneja el valor como texto, pero
     * al editar Eloquent ya lo devolvio convertido a enum por el cast del
     * modelo. Comparar contra texto funciona en un caso y falla en el
     * otro, y el sintoma es que los campos condicionales desaparecen solo
     * en la pantalla de edicion.
     */
    private static function typeOf($get): ?FooterBlockType
    {
        $value = $get('type');

        if ($value instanceof FooterBlockType) {
            return $value;
        }

        return FooterBlockType::tryFrom((string) $value);
    }

    private static function widthOf($get): ?BlockWidth
    {
        $value = $get('width');

        if ($value instanceof BlockWidth) {
            return $value;
        }

        return BlockWidth::tryFrom((string) $value);
    }
}
