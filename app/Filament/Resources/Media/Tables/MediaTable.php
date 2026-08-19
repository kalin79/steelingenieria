<?php

namespace App\Filament\Resources\Media\Tables;

use App\Enums\MediaType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MediaTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('path')
                    ->label('Vista previa')
                    ->disk('public')
                    ->square()
                    // Solo las imagenes tienen miniatura util. Para PDF y
                    // video se muestra la portada cuando existe.
                    ->visibility('public'),

                TextColumn::make('title')
                    ->label('Titulo')
                    ->placeholder('Sin titulo')
                    ->description(fn ($record) => $record->original_name)
                    ->searchable(['title', 'original_name'])
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge(),

                TextColumn::make('collection')
                    ->label('Agrupacion')
                    ->badge()
                    ->placeholder('—')
                    ->searchable(),

                TextColumn::make('dimensiones')
                    ->label('Dimensiones')
                    ->state(fn ($record) => $record->width && $record->height
                        ? "{$record->width} x {$record->height}"
                        : '—'),

                TextColumn::make('size')
                    ->label('Peso')
                    ->state(fn ($record) => $record->human_size)
                    ->sortable(),

                TextColumn::make('alt')
                    ->label('Texto alt')
                    ->placeholder('Falta')
                    ->limit(30)
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Subido')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options(MediaType::options()),

                SelectFilter::make('collection')
                    ->label('Agrupacion')
                    ->options(fn () => \App\Models\Media::query()
                        ->whereNotNull('collection')
                        ->distinct()
                        ->pluck('collection', 'collection')
                        ->all()),
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
