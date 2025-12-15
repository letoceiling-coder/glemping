<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class DefaultValue extends Model
{
    protected $guarded = false;
    public $timestamps = false;
    protected $casts = [
        'value_' => 'json',
    ];
}
