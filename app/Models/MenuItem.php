<?php

namespace App\Models;

use App\Concerns\FlushesLayoutCache;
use App\Enums\LinkTarget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class MenuItem extends Model
{
    use FlushesLayoutCache;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'target' => LinkTarget::class,
            'is_active' => 'boolean',
            'position' => 'integer',
        ];
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('position');
    }

    /**
     * Un enlace es externo si tiene esquema propio y su host no coincide
     * con el de la aplicacion. Se usa para decidir rel y para que el
     * componente Vue elija entre <Link> de Inertia y un <a> normal.
     */
    public function getIsExternalAttribute(): bool
    {
        if (! Str::startsWith($this->url, ['http://', 'https://'])) {
            return false;
        }

        return parse_url($this->url, PHP_URL_HOST) !== parse_url(config('app.url'), PHP_URL_HOST);
    }

    public function getRelValueAttribute(): ?string
    {
        if ($this->rel) {
            return $this->rel;
        }

        // Obligatorio por seguridad cuando se abre en ventana nueva:
        // sin noopener la pagina destino puede manipular la de origen.
        return $this->target === LinkTarget::Blank ? 'noopener noreferrer' : null;
    }
}
