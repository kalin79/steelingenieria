<?php

namespace App\Models;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            // Con este cast se asigna la contrasena en texto plano y
            // Laravel la encripta sola. Pasarle un Hash::make() ya hecho
            // la encriptaria dos veces y el login nunca validaria.
            'password' => 'hashed',
            'role' => UserRole::class,
            'is_active' => 'boolean',
        ];
    }

    /**
     * Quien puede entrar al panel.
     *
     * Dos condiciones: la cuenta tiene que estar activa y el rol tiene que
     * habilitar el acceso.
     *
     * Filament evalua esto en cada peticion al panel, no solo al iniciar
     * sesion: al desactivar a alguien que ya esta adentro, queda fuera en
     * su siguiente clic sin necesidad de cerrarle la sesion a mano.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if (! $this->is_active) {
            return false;
        }

        return $this->role?->puedeEntrarAlPanel() ?? false;
    }

    public function esAdmin(): bool
    {
        return $this->role === UserRole::Admin;
    }
}
