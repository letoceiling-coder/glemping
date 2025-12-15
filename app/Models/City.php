<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use Filterable;
    protected $guarded = false;
    public $timestamps = false;


    public function region(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Region::class,'id','region_id');
    }
    public function country(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Country::class,'id','country_id');
    }
    public function metro(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Metro::class,'city_id','id');
    }


}
