<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\AccessPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Http\Resources\StockResource;
use App\Models\Stock;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StockController extends Controller
{


    use HelperTrait;

    public function fields(): array
    {
        return [
            modelForm('slug', 'Ссылка'),
            modelForm('active', 'Активность ', 'active'),

            modelFormHide('image_id', 'Фото','image'),
           ];

    }

    public function __construct()

    {
        $this->middleware('auth:api', ['only' => ['store', 'update', 'destroy']]);

    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     * @throws BindingResolutionException
     */
    public function index(Request $request): AnonymousResourceCollection
    {

        if ($request->has('paginate') && $request->get('paginate') != 0) {

            return StockResource::collection(Stock::paginate($request->get('paginate'), ['*'], 'page', $request->get('page') ?? 1));

        } else {

            return StockResource::collection(Stock::get());
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreStockRequest $request
     * @return StockResource|array
     */

    public function store(StoreStockRequest $request): StockResource|array
    {
        $offer = Stock::create($request->validated());

        return new StockResource($offer);


    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return StockResource
     */
    public function show(string $id): StockResource
    {
        return new StockResource(Stock::find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateStockRequest $request
     * @param string $id
     */
    public function update(UpdateStockRequest $request, string $id): StockResource
    {
        $offer = Stock::find($id);
        $offer->update($request->validated());

        return new StockResource($offer);

    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $offer = Stock::findOrFail($id);

        if ($offer->system || AccessPermission::isDelete($request->user()->role_id)) {
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

        return response()->json($offer->delete(), 204);
    }
}
