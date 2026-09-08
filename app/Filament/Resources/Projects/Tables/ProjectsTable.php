<?php

namespace App\Filament\Resources\Projects\Tables;

use App\Models\Project;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imageDesktopMedia.path')
                    ->label('Portada')
                    ->disk('public')
                    ->height(40),

                TextColumn::make('title')
                    ->label('Proyecto')
                    ->searchable()
                    ->description(fn (Project $record) => $record->subtitle ?: null)
                    ->wrap(),

                TextColumn::make('slug')
                    ->label('Direccion')
                    ->formatStateUsing(fn (?string $state) => "/proyecto/{$state}")
                    ->color('gray')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('client')
                    ->label('Cliente')
                    ->placeholder('Sin cliente')
                    ->searchable(),

                TextColumn::make('execution')
                    ->label('Ejecucion')
                    ->placeholder('Sin fecha')
                    ->toggleable(),

                // Deja a la vista lo que falta antes de publicar. Es mas
                // barato verlo aca que descubrir en produccion que una
                // ficha comparte sin imagen o sin descripcion.
                TextColumn::make('completitud')
                    ->label('Contenido')
                    ->state(function (Project $record) {
                        $falta = [];

                        if (! $record->image_desktop_media_id) {
                            $falta[] = 'portada';
                        }

                        if (! $record->banner_desktop_media_id) {
                            $falta[] = 'banner';
                        }

                        if (blank($record->description)) {
                            $falta[] = 'descripcion';
                        }

                        return $falta === [] ? 'Completo' : 'Falta '.implode(', ', $falta);
                    })
                    ->badge()
                    ->color(fn ($state) => $state === 'Completo' ? 'success' : 'warning')
                    ->wrap(),

                IconColumn::make('is_active')
                    ->label('Visible')
                    ->boolean(),
            ])
            ->reorderable('position')
            ->defaultSort('position')
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Visibilidad')
                    ->placeholder('Todos')
                    ->trueLabel('Solo visibles')
                    ->falseLabel('Solo ocultos'),
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
