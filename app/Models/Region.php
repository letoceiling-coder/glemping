<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use Filterable;
    protected $guarded = false;
    public $timestamps = false;

    public function country(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Country::class,'id','country_id');
    }
}
