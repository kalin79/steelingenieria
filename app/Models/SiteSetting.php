<?php

namespace App\Models;

use App\Concerns\FlushesLayoutCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiteSetting extends Model
{
    use FlushesLayoutCache;

    protected $guarded = [];

    public static function current(): self
    {
        return static::query()->firstOrCreate([]);
    }

    public function logoHeaderMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'logo_header_media_id');
    }

    public function logoFooterMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'logo_footer_media_id');
    }

    public function getCopyrightTextAttribute(): string
    {
        return str_replace('{year}', (string) now()->year, (string) $this->copyright);
    }

    /** URL absoluta, venga de la biblioteca o del campo manual heredado. */
    public function getLogoHeaderUrlAttribute(): ?string
    {
        if ($this->logoHeaderMedia) {
            return $this->logoHeaderMedia->url;
        }

        return $this->logo_header ? url($this->logo_header) : null;
    }

    public function getLogoFooterUrlAttribute(): ?string
    {
        if ($this->logoFooterMedia) {
            return $this->logoFooterMedia->url;
        }

        return $this->logo_footer ? url($this->logo_footer) : null;
    }

    /** El alt del logo sale del archivo si esta cargado en la biblioteca. */
    public function getLogoAltTextAttribute(): string
    {
        return $this->logoHeaderMedia?->alt
            ?: ($this->logo_alt ?: (string) $this->site_name);
    }
}
