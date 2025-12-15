<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            "id" => $this->id,
            "uid" => $this->uid,
            "name" => $this->name,
            "code" => $this->code,
            "sign" => $this->sign,
            "nominal" => $this->nominal,
            "course" => (float)$this->course,
            "course_at" => $this->course_at,
            "status" => $this->status,
            "active" => $this->active,
        ];
    }
}
