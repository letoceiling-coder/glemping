<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use Filterable;
    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
      'data' => 'json',
      'statement_text' => 'json',
    ];
}
