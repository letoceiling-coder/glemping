<?php

namespace App\Http\Resources;

use App\Models\Image;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {

        return [

            'id' => $this->id,
            'uid' => $this->uid,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'slug' => "/catalog/".str($this->name)->slug(),
            'active' => $this->active,
            'images' => ImageResource::collection($this->images),
            'properties_info' => PropertyResource::collection($this->properties),
            'properties' => $this->properties->pluck('id'),
            'services' => $this->services->pluck('id'),
            'services_info' => ServiceResource::collection($this->services),
            'options' => $this->options->pluck('id'),
            'options_info' => OptionResource::collection($this->options),
            'bookings' => $this->bookings,
            'pos_x' => $this->pos_x,
            'pos_y' => $this->pos_y,
            'width' => $this->width,
            'height' => $this->height,
            'image_id' => $this->image_id,
            'places' => $this->places,
            'dop' => $this->dop,
            'square' => $this->square,
            'info' => $this->info,
            'additionally' => $this->additionally,
        ];
    }
}
