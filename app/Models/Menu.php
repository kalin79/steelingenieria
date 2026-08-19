<?php

namespace App\Models;

use App\Concerns\FlushesLayoutCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use FlushesLayoutCache;

    protected $guarded = [];

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }

    /** Solo los items de primer nivel, ya ordenados. */
    public function rootItems(): HasMany
    {
        return $this->hasMany(MenuItem::class)
            ->whereNull('parent_id')
            ->orderBy('position');
    }
}
