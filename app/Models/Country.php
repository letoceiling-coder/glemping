<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = false;
    public $timestamps = false;



    public function currency(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Currency::class,'code','currency_code');
    }
    public function language(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Language::class,'code','lang_code');
    }



}
