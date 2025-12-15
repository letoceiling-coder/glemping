<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        if ($this->preview_id ){

            $image = Image::find($this->preview_id);
            return [
                'id' => $this->id,
                'original' => $image->original,
                'webp' => $image->webp,
                'src' => $image->src,
                'folder' => [
                    'id' => $this->folder->id,
                    'name' => $this->folder->name,
                ],
                'name' => $this->name,
                'path' => $this->path,
                'width' => $this->width,
                'height' => $this->height,
                'extension' => $this->extension,
                'video' => "/videos/".$this->path. "." .$this->extension,

            ];
        }
        return [
            'id' => $this->id,
            'original' => $this->original,
            'webp' => $this->webp,
            'src' => $this->src,
            'folder' => [
                'id' => $this->folder->id,
                'name' => $this->folder->name,
            ],
            'name' => $this->name,
            'path' => $this->path,
            'width' => $this->width,
            'height' => $this->height,
            'extension' => $this->extension,


        ];
    }
}
