<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use Filterable;
    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
      'tags' => 'json'
    ];

    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Image::class,'id','image_id');
    }
    public function category(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Category::class,'id','category_id');
    }

}
