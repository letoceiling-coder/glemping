<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use Filterable;
    protected $guarded = false;
    public $timestamps = false;

    protected $casts = [
        'parent' => 'integer',
        'active' => 'boolean',
        'sort' => 'integer',
    ];
    protected $with = ['items'];

    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(self::class,'parent','id');
    }

    public function image(){
        return $this->hasOne(Image::class,'id','image_id');
    }
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
