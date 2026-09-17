<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

/**
 * Roles del panel.
 *
 * Hoy hay uno solo. Se modela como enum y no como una tabla de roles
 * porque con un unico rol y sin permisos por modulo, una tabla relacionada
 * agrega dos consultas y un mantenimiento que no compra nada.
 *
 * Cuando hagan falta mas roles, se agrega un case aca y su etiqueta: no
 * requiere migracion, porque la columna guarda el valor en texto. Recien
 * cuando cada rol necesite permisos distintos por recurso conviene evaluar
 * un paquete de permisos.
 */
enum UserRole: string implements HasColor, HasLabel
{
    case Admin = 'admin';

    public function getLabel(): string
    {
        return match ($this) {
            self::Admin => 'Administrador',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Admin => 'warning',
        };
    }

    /** Roles que pueden entrar al panel. */
    public function puedeEntrarAlPanel(): bool
    {
        return match ($this) {
            self::Admin => true,
        };
    }
}
