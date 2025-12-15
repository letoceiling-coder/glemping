<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use Filterable;
    protected $guarded = false;

    protected $casts = [

        'html' => 'json',
        'images' => 'json',
    ];


}
