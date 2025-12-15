<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerSwiperResource extends JsonResource
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
            'slug' => $this->slug,
            'image_d_id' => new ImageResource($this->imageD),
            'image_m_id' => new ImageResource($this->imageM),
            'active' => $this->active,
        ];
    }
}
