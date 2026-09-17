<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    /**
     * El campo de contrasena arranca vacio siempre.
     *
     * Sin esto, Filament cargaria el hash guardado dentro del input: se
     * veria como una contrasena larguisima y, al guardar, se encriptaria
     * el hash otra vez dejando al usuario sin poder entrar.
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['password'] = null;

        return $data;
    }
}
