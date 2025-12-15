<?php


namespace App\Helpers\Admin;


use App\Http\Resources\PageResource;

class Page
{

    static public function getPages(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return PageResource::collection(\App\Models\Page::all());
    }

    static public function getPage(string $slug): PageResource
    {
        return new PageResource(\App\Models\Page::firstWhere('slug',$slug));
    }

    static public function getPageId(string $id): PageResource
    {
        return new PageResource(\App\Models\Page::find('slug',$id));
    }
}
