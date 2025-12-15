<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'method' => $this->method,
            'size' => $this->size,
            'logo' => $this->logo,
            'popup' => $this->popup,
            'active' => $this->active,
            'statement_text' => $this->statement_text,
            'statement' => $this->statement,
            'save' => $this->save,
            'bitrix' => $this->bitrix,
            'sort' => $this->sort,
            'data' => $this->data,
        ];
    }
}
