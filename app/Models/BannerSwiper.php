<?php

namespace App\Models;


use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class BannerSwiper extends Model
{
    use Filterable;
    protected $guarded = [];
    public $timestamps = false;


    protected $appends = [
      'ratio_d','ratio_m'
    ];
    public function imageD(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Image::class,'id','image_d_id');
    }
    public function imageM(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Image::class,'id','image_m_id');
    }

    public function ratioD(): Attribute
    {
        return Attribute::make(

            get: fn() => $this->attributes['numerator_d'] . "/" . $this->attributes['denominator_d'],
        );
    }
    public function ratioM(): Attribute
    {
        return Attribute::make(

            get: fn() => $this->attributes['numerator_m'] . "/" . $this->attributes['denominator_m'],
        );
    }
}
