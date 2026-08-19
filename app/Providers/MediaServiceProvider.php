<?php

namespace App\Providers;

use App\Models\Media;
use App\Observers\MediaObserver;
use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Media::observe(MediaObserver::class);
    }
}
