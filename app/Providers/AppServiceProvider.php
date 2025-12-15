<?php

namespace App\Providers;

use App\Models\Currency;
use App\Models\Tag;
use App\Observers\Tags;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Tag::observe(Tags::class );
        if (!Cache::get('GetCourses')) {
            Cache::remember('GetCourses', 60 * 60 * 24, function () {
                return Currency::getCourses();
            });
        }

    }
}
