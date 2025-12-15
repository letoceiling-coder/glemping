<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class IncludeService extends Model
{
    use Filterable;

    protected $guarded = false;
    public $timestamps = false;

    protected $casts = [
        'enabled' => 'json',
        'additionally' => 'json',
    ];

    protected $with = ['image'];

    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Image::class,'id','image_id');
    }
}
