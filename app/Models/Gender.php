<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $guarded = false;
    public $timestamps = false;

    public function slug(): Attribute
    {
        return Attribute::make(

            set: fn() => str($this->attributes['name'])->slug(),
        );
    }
}
