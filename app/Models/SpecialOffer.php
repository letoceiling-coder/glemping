<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{
    use Filterable;

    protected $guarded = [];
    protected $with = ['offer'];
    public function offer(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Offer::class,'id','offer_id');
    }
}
