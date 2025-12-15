<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;

use App\Http\Resources\MenuResource;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return MenuResource::collection(Menu::orderBy('sort')->where('parent',0)->where('position','top')->get());
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreMenuRequest $request
     */
    public function store(StoreMenuRequest $request)
    {

        Menu::create($request->validated());
        return $this->index($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new MenuResource(Menu::find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMenuRequest $request
     * @param string $id
     * @return mixed
     */
    public function update(UpdateMenuRequest $request, string $id)
    {
        Menu::find($id)->update($request->validated());
        return $this->index($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param string $id
     * @return mixed
     */
    public function destroy(Request $request,string $id)
    {
        Menu::find($id)->delete();
        return $this->index($request);
    }

    public function updateSort(Request $request)
    {
        $ids = collect($request->all()['ids']);

        foreach ($ids as $key => $item) {

            foreach ($item['children'] as $children) {

                Menu::firstWhere('id', $children['id'])->update(['sort' => $children['sort'],'parent' => $item['parent']]);
            }

        }
        return $this->index($request);
    }
}
