<?php

namespace App\Http\Resources;

use App\Models\Blog;
use App\Models\Page;
use App\Models\SeoPage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        $seoTitle = '';
//        if ($request->has('path')){
//            $path = explode('/',$request->get('path'));
//            if (isset($path[3]) ){
//                if ($this->slug == '/blog'){
//                    $seoTitle =  Blog::find($path[3])->title;
//                    if ($seoTitle){
//                        $seoTitle = " | ".$seoTitle;
//                    }
//                }elseif ($this->slug == '/catalog'){
//
//                }
//
//
//            }
//        }


        $seoPage = SeoPage::firstWhere('slug',$this->slug);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'title' => $seoPage ? $seoPage->title :$this->title,
            'head' => $this->head,
            'description' => $seoPage ? $seoPage->description : $this->description,
            'data' => $this->data,
            'publish' => $this->publish,
            'active' => $this->active,
//            'seo' => [
//                'title' => $this->title .  $seoTitle,
//                'description' => $this->description .  $seoTitle,
//            ],
        ];
    }
}
