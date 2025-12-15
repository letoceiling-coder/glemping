<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\AccessPermission;
use App\Http\Controllers\Controller;
use App\Http\Filters\CurrencyFilter;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{

    use HelperTrait;

    public function fields(): array
    {

        return [
            modelForm('uid', 'uid '),
            modelForm('name', 'Наименование'),
            modelForm('code', 'Код валюты'),
            modelForm('sign', 'Иконка валюты'),
            modelForm('nominal', 'Номинал','integer'),
            modelForm('course', 'Курс','float'),
            modelForm('active', 'Активность','active'),

        ];
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        $filter = app()->make(CurrencyFilter::class, ['queryParams' => array_filter($request->all())]);

        if ($request->has('paginate')) {

            return CurrencyResource::collection(Currency::filter($filter)->paginate($request->get('paginate'), ['*'], 'page', $request->get('page') ?? 1));

        } else {
            return CurrencyResource::collection(Currency::filter($filter)->get());
        }

    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCurrencyRequest $request
     * @return CurrencyResource
     */
    public function store(StoreCurrencyRequest $request): CurrencyResource
    {
        $data = $request->validated();

        return new CurrencyResource(Currency::create($data));
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return CurrencyResource
     */
    public function show(string $id): CurrencyResource
    {
        return new CurrencyResource(Currency::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCurrencyRequest $request
     * @param string $id
     * @return CurrencyResource|\Illuminate\Http\JsonResponse
     */
    public function update(UpdateCurrencyRequest $request, string $id): CurrencyResource|\Illuminate\Http\JsonResponse
    {
        $currency = Currency::findOrFail($id);
        if (AccessPermission::isDelete($request->user()->role_id) || $currency->system) {
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
        $currency->update($request->validated());
        return new CurrencyResource($currency);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $currency = Currency::findOrFail($id);
        if (AccessPermission::isDelete($request->user()->role_id) || $currency->system) {
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
        return response()->json($currency->delete(), 204);
    }
}
