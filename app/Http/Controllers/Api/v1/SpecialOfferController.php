<?php


namespace App\Http\Controllers\Api\v1;


use App\Helpers\Admin\AccessPermission;
use App\Http\Controllers\Controller;
use App\Http\Filters\SpecialOfferFilter;
use App\Http\Requests\StoreSpecialOfferRequest;
use App\Http\Requests\UpdateSpecialOfferRequest;
use App\Http\Resources\SpecialOfferResource;
use App\Models\Offer;
use App\Models\SpecialOffer;
use Illuminate\Http\Request;

class SpecialOfferController extends Controller
{

    use HelperTrait;

    public function fields(): array
    {

        return [
            modelForm('title', 'Заголовок'),
            modelFormHide('offer_id', 'Выбрать предложение', 'select', false, Offer::select(['id', 'name'])->get()->toArray()),

        ];
    }
    public function __construct()

    {
        $this->middleware('auth:api', ['only' => ['store', 'update', 'destroy']]);

    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        $filter = app()->make(SpecialOfferFilter::class, ['queryParams' => array_filter($request->all())]);

        if ($request->has('paginate') && $request->get('paginate') != 0) {

            return SpecialOfferResource::collection(SpecialOffer::filter($filter)->paginate($request->get('paginate'), ['*'], 'page', $request->get('page') ?? 1));

        } else {

            return SpecialOfferResource::collection(SpecialOffer::filter($filter)->get());
        }

    }

    /**
     * @param StoreSpecialOfferRequest $request
     * @return SpecialOfferResource
     */

    public function store(StoreSpecialOfferRequest $request): SpecialOfferResource
    {

        return new SpecialOfferResource(SpecialOffer::create($request->validated()));
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return SpecialOfferResource
     */
    public function show(string $id): SpecialOfferResource
    {
        return new SpecialOfferResource(SpecialOffer::find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateSpecialOfferRequest $request
     * @param string $id
     */
    public function update(UpdateSpecialOfferRequest $request, string $id): SpecialOfferResource
    {

        return SpecialOffer::find($id)->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $offer = SpecialOffer::findOrFail($id);

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
