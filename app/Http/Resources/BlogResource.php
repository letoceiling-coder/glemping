<?php

namespace App\Http\Resources;

use App\Models\Image;
use App\Models\SeoPage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        $seoPage = SeoPage::firstWhere('slug',"/blog/article/" . $this->id);
        return [
            'id' => $this->id,
            'slug' => "/blog/article/" . $this->id,
            'title' => $seoPage ? $seoPage->title :$this->title,
            'images' => ImageResource::collection(Image::whereIn('id',$this->images)->get()),
            'date' => $this->date,
            'html' => $this->html,
            'active' => $this->active,
            'sort' => $this->sort,

        ];
    }
}
