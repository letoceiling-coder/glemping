<?php

namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIncludeRequest;
use App\Http\Requests\UpdateIncludeRequest;

use App\Http\Resources\IncludeResource;
use App\Models\IncludeService;

use Illuminate\Http\JsonResponse;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IncludeController extends Controller
{

    use HelperTrait;

    public function fields(): array
    {

        return [
            modelForm('title', 'Заголовок'),
            modelFormHide('description', 'Описание'),
            modelFormHide('enabled', 'Включено','text'),
            modelFormHide('additionally', 'Дополнительно','text'),
            modelFormHide('image_id', 'Фото','image'),

        ];
    }
    public function __construct()

    {
        $this->middleware('auth:api', ['only' => ['store', 'update', 'destroy']]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return IncludeResource::collection(IncludeService::all());
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreIncludeRequest $request
     * @return AnonymousResourceCollection
     */
    public function store(StoreIncludeRequest $request): AnonymousResourceCollection
    {
         IncludeService::create($request->validated());
        return $this->index();
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return mixed
     */
    public function show(string $id): mixed
    {
        return new IncludeResource(IncludeService::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateIncludeRequest $request
     * @param string $id
     * @return AnonymousResourceCollection
     */
    public function update(UpdateIncludeRequest $request, string $id): AnonymousResourceCollection
    {
        $property = IncludeService::findOrFail($id);
        $property->update($request->validated());
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $property = IncludeService::findOrFail($id);
        $property->delete();
        return response()->json(null,204);
    }


}
