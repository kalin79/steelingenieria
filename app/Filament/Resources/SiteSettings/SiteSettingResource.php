<?php

namespace App\Filament\Resources\SiteSettings;

use App\Filament\Resources\SiteSettings\Pages\EditSiteSetting;
use App\Filament\Resources\SiteSettings\Pages\ListSiteSettings;
use App\Filament\Resources\SiteSettings\Schemas\SiteSettingForm;
use App\Filament\Resources\SiteSettings\Tables\SiteSettingsTable;
use App\Models\SiteSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $recordTitleAttribute = 'site_name';

    protected static ?string $navigationLabel = 'Configuracion del sitio';

    protected static ?string $modelLabel = 'Configuracion del sitio';

    protected static ?string $pluralModelLabel = 'Configuracion del sitio';

    /**
     * Oculto del menu lateral.
     *
     * Solo saca el enlace de la navegacion: la ruta del recurso sigue
     * viva, asi que /admin/... entrando a mano continua funcionando para
     * quien conozca la direccion. Es lo correcto para modulos que se
     * configuran una vez y no se tocan a diario, sin perder la puerta de
     * atras para mantenimiento.
     *
     * Si lo que hace falta es BLOQUEAR el acceso y no solo esconderlo,
     * el metodo es canAccess(): return false.
     */
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return SiteSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiteSettingsTable::configure($table);
    }

    /**
     * Es una configuracion de fila unica: no tiene sentido crear una
     * segunda ni borrar la existente. Se oculta el boton de crear y se
     * bloquea el borrado a nivel de autorizacion del recurso.
     */
    public static function canCreate(): bool
    {
        return ! SiteSetting::query()->exists();
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSiteSettings::route('/'),
            'edit' => EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
