<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use Filterable;
    protected $guarded = false;
    public $timestamps = false;

    protected $with =[
        'image'
    ];

    public function image(){
        return $this->hasOne(Image::class,'id','image_id');
    }
}
