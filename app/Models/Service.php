<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Filterable;

    protected $guarded = false;
    public $timestamps = false;


    protected $casts = [
        'description' => 'json'
    ];

    protected $with = ['image','images'];

    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {

        return $this->belongsToMany(Image::class);
    }
}
