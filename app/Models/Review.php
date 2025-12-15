<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use Filterable;

    protected $guarded = false;
    public $timestamps = false;

    protected $with = [
        'images'
    ];

    public function images(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Image::class);
    }
}
