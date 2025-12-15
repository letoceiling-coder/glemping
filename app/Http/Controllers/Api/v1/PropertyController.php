<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Filter\SortModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PropertyController extends Controller
{

    use HelperTrait;

    public function fields(): array
    {

        return [
            modelForm('name', 'Наименование свойства'),

        ];
    }
    public function __construct()

    {
        $this->middleware('auth:api', ['only' => ['store', 'update', 'destroy']]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return PropertyResource::collection(Property::all());
    }

    /**
     * Store a newly created resource in storage.
     * @param StorePropertyRequest $request
     * @return mixed
     */
    public function store(StorePropertyRequest $request): mixed
    {
         Property::create($request->validated());
        return $this->index();
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return mixed
     */
    public function show(string $id): mixed
    {
        return new PropertyResource(Property::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdatePropertyRequest $request
     * @param string $id
     */
    public function update(UpdatePropertyRequest $request, string $id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $property = Property::findOrFail($id);
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
        $property = Property::findOrFail($id);
        $property->delete();
        return response()->json(null,204);
    }


}
