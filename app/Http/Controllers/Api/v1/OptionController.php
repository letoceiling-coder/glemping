<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Http\Resources\OptionResource;
use App\Models\Option;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OptionController extends Controller
{
    use HelperTrait;

    public function fields(): array
    {

        return [
            modelForm('name', 'Наименование '),
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
        return OptionResource::collection(Option::all());
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreOptionRequest $request
     *
     */
    public function store( StoreOptionRequest $request): AnonymousResourceCollection
    {
        Option::create($request->validated());
        return $this->index();
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return mixed
     */
    public function show(string $id): mixed
    {
        return new OptionResource(Option::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateOptionRequest $request
     * @param string $id
     * @return AnonymousResourceCollection
     */
    public function update(UpdateOptionRequest $request, string $id): AnonymousResourceCollection
    {
        $property = Option::findOrFail($id);
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
        $property = Option::findOrFail($id);
        $property->delete();
        return response()->json(null,204);
    }

}
