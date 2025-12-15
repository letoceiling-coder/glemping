<?php

namespace App\Observers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class Settings
{
    /**
     * Handle the Setting "created" event.
     * @param Setting $setting
     */
    public function created(Setting $setting): void
    {
        Cache::forget('InfoSite');
    }

    /**
     * Handle the Setting "updated" event.
     * @param Setting $setting
     */
    public function updated(Setting $setting): void
    {
        Cache::forget('InfoSite');
    }

}
