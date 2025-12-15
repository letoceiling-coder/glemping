<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\AccessPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\StoreSizeTagRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Http\Requests\UpdateSizeTagsRequest;
use App\Http\Resources\SizeResource;
use App\Http\Resources\TagResource;
use App\Models\Category;
use App\Models\DefaultValue;
use App\Models\Size;

use App\Models\Tag;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    use HelperTrait;

    public function addTags(UpdateSizeTagsRequest $request): array
    {
        $size = Size::create(['category_id' => $request->get('category_id')]);
        return $tags = $size->tags()->sync($request->get('tags'),['category_id' => $request->get('category_id')]);



    }

    public function addTag(StoreSizeTagRequest $request): array
    {

    }
    public function fields(): array
    {
        $categories = Category::select(['id', 'name'])->get()->toArray();
        $tags = TagResource::collection(Tag::all());
        return [
            'tags' => $tags,
            'categories' => $categories,
            'default' => [
                [
                    'type' => 'select',
                    'relationship' => 'sizes',
                    'label' => 'Размер по умолчанию',
                    'value' => DefaultValue::firstWhere('key_', 'sizes')->value_,
                    'selects' => $tags
                ]
            ],
            'fields' => [


                modelForm('image_id', 'Фото', 'image'),
                modelForm('category_id', 'Категория ', 'select', true, $categories),
                modelFormHide('description', 'Описание'),
                modelForm('active', 'Активность', 'active'),
                modelForm('sort', 'Сортировка', 'integer'),
            ]


        ];
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {


        if ($request->has('paginate')) {

            return SizeResource::collection(Size::paginate($request->get('paginate'), ['*'], 'page', $request->get('page') ?? 1));

        } else {
            return SizeResource::collection(Size::get());
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreSizeRequest $request
     * @return SizeResource
     */
    public function store(StoreSizeRequest $request)
    {
        $data = $request->validated();

        return new SizeResource(Size::create($data));
    }

    /**
     * Display the specified resource.
     * @param string $id
     *
     */
    public function show(string $id)
    {
        return new SizeResource(Size::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateSizeRequest $request
     * @param string $id
     * @return SizeResource|\Illuminate\Http\JsonResponse
     */
    public function update(UpdateSizeRequest $request, string $id): \Illuminate\Http\JsonResponse|SizeResource
    {
        $size = Size::findOrFail($id);
        if (AccessPermission::isDelete($request->user()->role_id) || $size->system) {
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
        $size->update($request->validated());
        return new SizeResource($size);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $size = Size::findOrFail($id);
        if (AccessPermission::isDelete($request->user()->role_id) || $size->system) {
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
        return response()->json($size->delete(), 204);
    }
}
