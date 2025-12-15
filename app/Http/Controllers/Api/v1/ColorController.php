<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\AccessPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Http\Resources\ColorResource;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    use HelperTrait;

    public function fields(): array
    {

        return [

            'fields' => [
                modelForm('name', 'Наименование'),
                modelForm('hex', 'Цвет','color'),
                modelForm('active', 'Активность','active'),
                modelFormSizeImageHide('image_id', 'Фото', 'image-upload'),

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

            return ColorResource::collection(Color::paginate($request->get('paginate'), ['*'], 'page', $request->get('page') ?? 1));

        } else {
            return ColorResource::collection(Color::get());
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreColorRequest $request
     * @return ColorResource
     */
    public function store(StoreColorRequest $request): ColorResource
    {
        $data = $request->validated();

        return new ColorResource(Color::create($data));
    }

    /**
     * Display the specified resource.
     * @param string $id
     *
     */
    public function show(string $id): ColorResource
    {
        return new ColorResource(Color::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateColorRequest $request
     * @param string $id
     * @return ColorResource|\Illuminate\Http\JsonResponse
     */
    public function update(UpdateColorRequest $request, string $id): \Illuminate\Http\JsonResponse|ColorResource
    {
        $color = Color::findOrFail($id);
        if (AccessPermission::isDelete($request->user()->role_id) || $color->system) {
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
        $color->update($request->validated());
        return new ColorResource($color);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $color = Color::findOrFail($id);
        if (AccessPermission::isDelete($request->user()->role_id) || $color->system) {
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
        return response()->json($color->delete(), 204);
    }
}
