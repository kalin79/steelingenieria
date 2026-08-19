<?php

namespace App\Filament\Resources\FooterBlocks;

use App\Filament\Resources\FooterBlocks\Pages\CreateFooterBlock;
use App\Filament\Resources\FooterBlocks\Pages\EditFooterBlock;
use App\Filament\Resources\FooterBlocks\Pages\ListFooterBlocks;
use App\Filament\Resources\FooterBlocks\Schemas\FooterBlockForm;
use App\Filament\Resources\FooterBlocks\Tables\FooterBlocksTable;
use App\Models\FooterBlock;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FooterBlockResource extends Resource
{
    protected static ?string $model = FooterBlock::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return FooterBlockForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FooterBlocksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFooterBlocks::route('/'),
            'create' => CreateFooterBlock::route('/create'),
            'edit' => EditFooterBlock::route('/{record}/edit'),
        ];
    }
}
