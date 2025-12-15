<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class EmailSend extends Model
{
    use Filterable;
    protected $guarded = false;

    protected $casts = [
        'data' => 'json'
    ];
}
