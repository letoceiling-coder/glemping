<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
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
            'post' => $this->post,
            'info' => $this->info,
            'active' => $this->active,
            'sort' => $this->sort,
            'image_id' => new ImageResource($this->image),
        ];
    }
}
