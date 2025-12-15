<?php

namespace App\Models;

use App\Models\Traits\Filterable;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use Filterable;
    protected $guarded = false;

    protected $casts = [
        'data' => 'json',
        'active' => 'boolean',
        'publish' => 'boolean',
    ];


    public function seoPage(){
        $this->hasOne(SeoPage::class,'slug','slug');
    }
    public function concatName(): string
    {
        return Str::lower($this->attributes['name']);
    }
    public function nameSpace(): Attribute
    {

        return Attribute::make(

            set: fn () => str($this->concatName())->slug(),
        );
    }

    public function active(): Attribute
    {

        return Attribute::make(
            set: fn (bool $value) => isBoolean($value),
        );
    }

    public function publish(): Attribute
    {

        return Attribute::make(
            set: fn (bool $value) => isBoolean($value),
        );
    }

    public function slug(): Attribute
    {


        return Attribute::make(
            set: fn (string $value) => Str::substr('/slug', 0,1) != '/' ? "/".$value : $value,
        );
    }
    public function name(): Attribute
    {

        return Attribute::make(
            set: fn (string $value) => Str::ucfirst($value),
        );
    }
    public function title(): Attribute
    {

        return Attribute::make(
            set: fn (string $value) => Str::ucfirst($value),
        );
    }
    public function head(): Attribute
    {

        return Attribute::make(
            set: fn (string $value) => Str::ucfirst($value),
        );
    }


    public function description(): Attribute
    {

        return Attribute::make(
            set: fn (string $value) => Str::ucfirst($value),
        );
    }
}
