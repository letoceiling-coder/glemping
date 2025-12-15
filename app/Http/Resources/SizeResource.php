<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SizeResource extends JsonResource
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
            'tags' => $this->tags,
            'size_default' => $this->size_default,
            'active' => $this->active,
            'sort' => $this->sort,
            'image_id' => new ImageResource($this->image),
            'category_id' => $this->category_id,
            'category' => new CategoryResource($this->category),

        ];
    }
}
