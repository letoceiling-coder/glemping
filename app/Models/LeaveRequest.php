<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $guarded = false;
    use Filterable;
}
