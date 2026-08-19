<?php

namespace App\Filament\Resources\FooterBlocks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FooterBlocksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge(),

                TextColumn::make('title')
                    ->label('Titulo')
                    ->placeholder('Sin titulo')
                    ->searchable(),

                TextColumn::make('menu.name')
                    ->label('Menu')
                    ->placeholder('—')
                    ->badge(),

                TextColumn::make('width')
                    ->label('Ancho')
                    ->badge(),

                TextColumn::make('column_span')
                    ->label('Columnas')
                    ->alignCenter()
                    ->formatStateUsing(fn ($state, $record) => $record->width->value === 'full' ? '12' : $state),

                IconColumn::make('is_active')
                    ->label('Visible')
                    ->boolean(),
            ])
            ->reorderable('position')
            ->defaultSort('position')
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
