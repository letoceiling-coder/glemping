<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use Filterable;
    protected $guarded = [];
    public $timestamps = false;


    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'category_tags','category_id','tag_id');
    }
    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Image::class,'id','image_id');
    }
    protected $casts = [
        'parent' => 'integer',
        'active' => 'boolean',
        'sort' => 'integer',
    ];

    public function active(): Attribute
    {
        return Attribute::make(
            set: fn (bool $value) => isBoolean($value),
        );
    }


    public function name(): Attribute
    {

        return Attribute::make(
            set: fn (string $value) => Str::ucfirst($value),
        );
    }
}
