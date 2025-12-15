<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\AccessPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Models\UserRole;
use Illuminate\Http\Request;

class TagController extends Controller
{
    use HelperTrait;

    public function fields()
    {

        return [
            modelForm('name', 'Тег'),

        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return TagResource::collection(Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreTagRequest $request
     *
     */
    public function store(StoreTagRequest $request): TagResource
    {
        return new TagResource(Tag::create($request->validated()));
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return TagResource
     */
    public function show(string $id): TagResource
    {
        return new TagResource(Tag::find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param StoreTagRequest $request
     * @param string $id
     * @return TagResource
     */
    public function update(StoreTagRequest $request, string $id): TagResource
    {
        Tag::find($id)->update($request->validated());
        return $this->show($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $tag = Tag::findOrFail($id);
        if (AccessPermission::isDelete($request->user()->role_id) ) {
            return response()->json([
                'errors' => [
                    'alert' => [
                        'title' => 'Что то пошло не так',
                        'text' => 'У вас нет прав на удаление',
                        'type' => 'error',
                    ]
                ]
            ], 422);

        }
        return response()->json($tag->delete(), 204);
    }
}
