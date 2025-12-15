<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDefaultValueRequest;
use App\Models\DefaultValue;
use Illuminate\Http\Request;

class DefaultValueController extends Controller
{
    public function defaultValuesChange(UpdateDefaultValueRequest $request, string $key)
    {

        if (DefaultValue::firstWhere('key_', $key)?->update($request->validated())) {
            return [
                'title' => 'Уведомление',
                'text' => 'Успешно изменено',
                'type' => 'success',
            ];
        }
        return [
            'title' => 'Что то пошло не так',
            'text' => 'Ошибка изменений',
            'type' => 'error',
        ];
    }
}
