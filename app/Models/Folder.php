<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $guarded = false;
    public $timestamps = false;

    protected $casts = [
        'slug' => 'string',
        'name' => 'string',
        'sort' => 'integer',
        'system' => 'boolean',

    ];
    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Image::class,'folder_id','id');
    }

    public function slug(): Attribute
    {
        return Attribute::make(

            set: fn() => $this->slug ? $this->slug : str($this->name)->slug(),
        );
    }
}
