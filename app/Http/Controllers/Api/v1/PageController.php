<?php

namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function page(Request $request){

        $page = Page::firstWhere('slug',$request->get('path'));
        if ($page){
            return new PageResource($page);
        }
        $path = explode('/',$request->get('path'));
        if (isset($path[1]) ){
            $page = Page::firstWhere('slug','LIKE','%/'.$path[1]);
            if ($page){
                return new PageResource($page);
            }
        }

        return response()->json(null,204);

    }

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return PageResource::collection(Page::all());
    }

    /**
     * Store a newly created resource in storage.
     * @param StorePageRequest $request
     */
    public function store(StorePageRequest $request): PageResource
    {
        return new PageResource(Page::create($request->validated()));
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return mixed
     */
    public function show(string $id): mixed
    {

        return new PageResource(Page::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdatePageRequest $request
     * @param string $id
     */
    public function update(UpdatePageRequest $request, string $id)
    {
        $page = Page::findOrFail($id);
        $page->update($request->validated());
        return $this->show($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
