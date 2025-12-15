<?php

namespace App\Observers;

use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

class Tags
{
    /**
     * Handle the Setting "created" event.
     * @param Tag $tag
     */
    public function created(Tag $tag): void
    {
        Cache::forget('Tags_');
    }

    /**
     * Handle the Setting "updated" event.
     * @param Tag $tag
     */
    public function updated(Tag $tag): void
    {
        Cache::forget('Tags_');
    }

}
