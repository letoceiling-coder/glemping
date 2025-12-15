<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\AccessPermission;
use App\Http\Controllers\Controller;
use App\Http\Filters\OfferFilter;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use App\Models\Option;
use App\Models\Property;
use App\Models\Service;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OfferController extends Controller
{


    use HelperTrait;

    public function fields(): array
    {
        return [
            modelForm('name', 'Заголовок'),
            modelFormHide('uid', 'uid','integer'),
            modelFormHide('description', 'Описание'),
            modelFormHide('price', 'Стоимость', 'integer'),
            modelFormHide('places', 'Количество мест', 'integer'),
            modelFormHide('dop', 'Количество доп.мест', 'integer'),
            modelFormHide('square', 'Площадь', 'integer'),
            modelFormHide('info', 'Информация', 'html'),
            modelFormHide('additionally', 'Дополнительно', 'html'),
            modelForm('active', 'Активность ', 'active'),
            modelFormHide('images', 'фото', 'images'),
            modelFormHide('properties', 'Выбрать свойства', 'select-all', false, Property::select(['id', 'name'])->get()->toArray()),
            modelFormHide('services', 'Выбрать сервисы', 'select-all', false, Service::select(['id', 'name'])->get()->toArray()),
            modelFormHide('options', 'Выбрать опции', 'select-all', false, Option::select(['id', 'name'])->get()->toArray()),
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

        $filter = app()->make(OfferFilter::class, ['queryParams' => array_filter($request->all())]);

        if ($request->has('paginate') && $request->get('paginate') != 0) {

            return OfferResource::collection(Offer::filter($filter)->paginate($request->get('paginate'), ['*'], 'page', $request->get('page') ?? 1));

        } else {

            return OfferResource::collection(Offer::filter($filter)->get());
        }

    }

    /**
     * Store a newly created resource in storage.
     * @param StoreOfferRequest $request
     * @return OfferResource|array
     */

    public function store(StoreOfferRequest $request): OfferResource|array
    {
        $offer = Offer::create($request->validated());
        if ($request->has('images')) {
            $offer->images()->sync(collect($request->get('images'))->pluck('id')->toArray());
        }
        if ($request->has('properties')) {
            $offer->properties()->sync($request->get('properties'));
        }
        if ($request->has('services')) {
            $offer->services()->sync($request->get('services'));
        }
        if ($request->has('options')) {
            $offer->options()->sync($request->get('options'));
        }
        return new OfferResource($offer);


    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return OfferResource
     */
    public function show(string $id): OfferResource
    {
        return new OfferResource(Offer::with('properties')->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateOfferRequest $request
     * @param string $id
     */
    public function update(UpdateOfferRequest $request, string $id): OfferResource
    {
        $offer = Offer::find($id);
        $offer->update($request->validated());
        if ($request->has('images')) {
            $offer->images()->sync(collect($request->get('images'))->pluck('id')->toArray());
        }
        if ($request->has('properties')) {
            $offer->properties()->sync($request->get('properties'));
        }

        if ($request->has('services')) {
            $offer->services()->sync($request->get('services'));
        }
        if ($request->has('options')) {
            $offer->options()->sync($request->get('options'));
        }
        return new OfferResource($offer);

    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $offer = Offer::findOrFail($id);

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
