<?php

namespace App\Http\Controllers\Api\v1\Form;

use App\Http\Controllers\Api\v1\HelperTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendLeaveRequest;

use App\Models\LeaveRequest;


class LeaveRequestController extends Controller
{
    use HelperTrait;

    public function send(SendLeaveRequest $request)
    {

        $data = $request->validated();

        return LeaveRequest::create([
            'name' => $data['name']['value'],
            'phone' => $data['phone']['value'],
            'comment' => $data['comment']['value'],
        ]);
    }


}
