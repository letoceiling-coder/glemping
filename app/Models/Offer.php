<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
class Offer extends Model
{
    use Filterable;

    protected $guarded = [];

    protected $with = [
        'images', 'bookings', 'image','services','options'
    ];

    protected $casts = [

        'info' => 'json',
        'additionally' => 'json',
    ];


    public function gender(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Gender::class, 'id', 'gender_id');
    }

    public function currency(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Category::class, 'id', 'color_id');
    }

    public function color(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Color::class, 'id', 'color_id');
    }

    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }

    public function colors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Color::class, 'id', 'color_id');
    }

    public function size(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Size::class, 'id', 'size_id');
    }

    public function sizes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Size::class, 'id', 'size_id');
    }

    public function region(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Region::class, 'id', 'region_id');
    }

    public function properties(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'property_offer');
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {

        return $this->belongsToMany(Image::class);
    }

    public function bookings(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Booking::class);
    }

    public function services(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function options(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }


}
