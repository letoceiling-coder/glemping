<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->image){
            return [
                'id' => $this->id ,
                'name' => $this->name ,
                'active' => $this->active ,
                'image_id' => new ImageResource($this->image),
            ];
        }
        return [
            'id' => $this->id ,
            'name' => $this->name ,
            'hex' => $this->hex ,
            'active' => $this->active ,

        ];
    }
}
