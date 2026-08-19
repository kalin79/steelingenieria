<?php

namespace App\Models;

use App\Enums\MediaType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

class Media extends Model
{
    protected $table = 'media';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'type' => MediaType::class,
            'size' => 'integer',
            'width' => 'integer',
            'height' => 'integer',
            'duration' => 'integer',
        ];
    }

    public function poster(): BelongsTo
    {
        return $this->belongsTo(self::class, 'poster_id');
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function scopeOfType(Builder $query, MediaType $type): Builder
    {
        return $query->where('type', $type);
    }

    public function getUrlAttribute(): ?string
    {
        if (blank($this->path)) {
            return null;
        }

        return Storage::disk($this->disk)->url($this->path);
    }

    public function getIsImageAttribute(): bool
    {
        return $this->type === MediaType::Image;
    }

    public function getIsVideoAttribute(): bool
    {
        return $this->type === MediaType::Video;
    }

    public function getIsDocumentAttribute(): bool
    {
        return $this->type === MediaType::Document;
    }

    /** Relacion ancho/alto, util para reservar espacio antes de cargar. */
    public function getAspectRatioAttribute(): ?string
    {
        if (! $this->width || ! $this->height) {
            return null;
        }

        return "{$this->width} / {$this->height}";
    }

    public function getHumanSizeAttribute(): string
    {
        return Number::fileSize($this->size, precision: 1);
    }

    /** Estructura lista para enviar a Vue. */
    public function toPayload(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type->value,
            'url' => $this->url,
            'alt' => $this->alt ?? '',
            'title' => $this->title,
            'caption' => $this->caption,
            'width' => $this->width,
            'height' => $this->height,
            'aspectRatio' => $this->aspect_ratio,
            'mimeType' => $this->mime_type,
            'size' => $this->size,
            'humanSize' => $this->human_size,
            'duration' => $this->duration,
            'poster' => $this->poster?->url,
        ];
    }
}
