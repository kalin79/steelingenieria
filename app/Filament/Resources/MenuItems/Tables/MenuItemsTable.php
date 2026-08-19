<?php

namespace App\Filament\Resources\MenuItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MenuItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->label('Texto')
                    ->searchable()
                    // Indenta visualmente los hijos para que se lea la jerarquia
                    // sin tener que abrir cada registro.
                    ->formatStateUsing(fn ($state, $record) => $record->parent_id ? "— {$state}" : $state),

                TextColumn::make('menu.name')
                    ->label('Menu')
                    ->badge()
                    ->sortable(),

                TextColumn::make('parent.label')
                    ->label('Depende de')
                    ->placeholder('Primer nivel')
                    ->toggleable(),

                TextColumn::make('url')
                    ->label('Enlace')
                    ->limit(40)
                    ->searchable(),

                TextColumn::make('target')
                    ->label('Abre en')
                    ->badge(),

                IconColumn::make('is_active')
                    ->label('Visible')
                    ->boolean(),
            ])
            // Arrastrar para ordenar. Escribe directo sobre la columna position.
            ->reorderable('position')
            ->defaultSort('position')
            ->filters([
                SelectFilter::make('menu_id')
                    ->label('Menu')
                    ->relationship('menu', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
