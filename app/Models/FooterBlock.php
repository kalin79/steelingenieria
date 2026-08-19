<?php

namespace App\Models;

use App\Concerns\FlushesLayoutCache;
use App\Enums\BlockWidth;
use App\Enums\FooterBlockType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FooterBlock extends Model
{
    use FlushesLayoutCache;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'type' => FooterBlockType::class,
            'width' => BlockWidth::class,
            'is_active' => 'boolean',
            'position' => 'integer',
            'column_span' => 'integer',
        ];
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('position');
    }
}
