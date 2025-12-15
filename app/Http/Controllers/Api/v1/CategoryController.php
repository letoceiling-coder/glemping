<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryTagsRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{

    public function tagsSync(CategoryTagsRequest $request){
        $category = Category::findOrFail($request->get('category_id'));

        return $category->tags()->sync($request->get('tags'),['category_id' => $request->get('category_id')]);

    }
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::orderBy('sort')->where('parent', 0)->get());
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCategoryRequest $request
     */
    public function store(StoreCategoryRequest $request): AnonymousResourceCollection
    {

        Category::create($request->validated());
        return $this->index($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new CategoryResource(Category::find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCategoryRequest $request
     * @param string $id
     * @return mixed
     */
    public function update(UpdateCategoryRequest $request, string $id): mixed
    {
        Category::find($id)->update($request->validated());
        return $this->index($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param string $id
     * @return mixed
     */
    public function destroy(Request $request, string $id)
    {
        Category::find($id)->delete();
        return $this->index($request);
    }

    public function updateSort(Request $request): AnonymousResourceCollection
    {
        $ids = collect($request->all()['ids']);

        foreach ($ids as $key => $item) {

            foreach ($item['children'] as $children) {

                Category::firstWhere('id', $children['id'])->update(['sort' => $children['sort'], 'parent' => $item['parent']]);
            }

        }
        return $this->index($request);
    }
}
