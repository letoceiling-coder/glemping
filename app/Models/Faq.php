<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use Filterable;
    protected $guarded = false;
    public $timestamps = false;
    protected $casts = [
        'answer' => 'json'
    ];
}
