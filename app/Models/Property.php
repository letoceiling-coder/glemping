<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use Filterable;
    protected $guarded = [];
    public $timestamps = false;
}
