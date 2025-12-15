<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use Filterable;
    protected $guarded = [];
    public $timestamps = false;

    public function image(){
        return $this->hasOne(Image::class,'id','image_id');
    }
}
