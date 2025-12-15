<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\AccessPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenderRequest;
use App\Http\Requests\UpdateGenderRequest;
use App\Http\Resources\GenderResource;
use App\Models\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    use HelperTrait;

    public function fields(): array
    {

        return [
            'fields' => [
                modelForm('name', 'Наименование'),

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

            return GenderResource::collection(Gender::paginate($request->get('paginate'), ['*'], 'page', $request->get('page') ?? 1));

        } else {
            return GenderResource::collection(Gender::get());
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreGenderRequest $request
     * @return GenderResource
     */
    public function store(StoreGenderRequest $request): GenderResource
    {
        $data = $request->validated();
        $data['slug'] = null;
        return new GenderResource(Gender::create($data));
    }

    /**
     * Display the specified resource.
     * @param string $id
     *
     */
    public function show(string $id): GenderResource
    {
        return new GenderResource(Gender::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @param StoreGenderRequest $request
     * @param string $id
     * @return GenderResource|\Illuminate\Http\JsonResponse
     */
    public function update(StoreGenderRequest $request, string $id): \Illuminate\Http\JsonResponse|GenderResource
    {
        $gender = Gender::findOrFail($id);
        if (AccessPermission::isDelete($request->user()->role_id) || $gender->system) {
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
        $data = $request->validated();
        $data['slug'] = null;
        $gender->update($data);
        return new GenderResource($gender);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $gender = Gender::findOrFail($id);
        if (AccessPermission::isDelete($request->user()->role_id) || $gender->system) {
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
        return response()->json($gender->delete(), 204);
    }
}
