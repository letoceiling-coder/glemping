<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ServiceController extends Controller
{
    use HelperTrait;

    public function fields(): array
    {

        return [
            modelForm('name', 'Наименование '),
            modelFormHide('price', 'Стоимость','integer'),
            modelFormHide('images', 'фото', 'images'),
            modelFormHide('description', 'Описание','html'),

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
        return ServiceResource::collection(Service::all());
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreServiceRequest $request
     * @return AnonymousResourceCollection
     */
    public function store( StoreServiceRequest $request): AnonymousResourceCollection
    {
        $service = Service::create($request->validated());

        if ($request->has('images')) {
            $service->images()->sync(collect($request->get('images'))->pluck('id')->toArray());
        }
        return $this->index();
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return mixed
     */
    public function show(string $id): mixed
    {
        return new ServiceResource(Service::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateServiceRequest $request
     * @param string $id
     * @return AnonymousResourceCollection
     */
    public function update(UpdateServiceRequest $request, string $id): AnonymousResourceCollection
    {
        $service = Service::findOrFail($id);
        $service->update($request->validated());


        if ($request->has('images')) {
            $service->images()->sync(collect($request->get('images'))->pluck('id')->toArray());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $property = Service::findOrFail($id);
        $property->delete();
        return response()->json(null,204);
    }

}
