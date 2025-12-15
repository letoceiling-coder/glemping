<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\AccessPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePublishRequest;
use App\Http\Requests\UpdatePublishRequest;
use App\Http\Resources\PublishResource;
use App\Models\Publish;
use Illuminate\Http\Request;

class PublishController extends Controller
{

    use HelperTrait;
    public function __construct()

    {
        $this->middleware('auth:api', ['only' => ['store','update','destroy']]);

    }

    public function fields(): array
    {

        return collect([
            addForm('title', 'Заголовок')->sort(1)->send(),
            addForm('slug', 'Ссылка')->hide()->send(),
            addForm('image_id', 'Фото ','image')->sort(0)->send(),
            addForm('active', 'Активность ','active')->send(),
            addForm('sort', 'Сортировка ','integer')->send(),

        ])->toArray();
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        if ($request->has('paginate')) {

            return PublishResource::collection(Publish::paginate($request->get('paginate'), ['*'], 'page', $request->get('page') ?? 1));

        } else {
            return PublishResource::collection(Publish::get());
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     * @param StorePublishRequest $request
     * @return PublishResource
     */
    public function store(StorePublishRequest $request): PublishResource
    {
        return new PublishResource(Publish::create($request->validated()));
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return PublishResource
     */
    public function show(string $id): PublishResource
    {
        return new PublishResource(Publish::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdatePublishRequest $request
     * @param string $id
     * @return PublishResource
     */
    public function update(UpdatePublishRequest $request, string $id): PublishResource
    {
        $publish = Publish::findOrFail($id);
        $publish->update($request->validated());
        return $this->show($id);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request,string $id): \Illuminate\Http\JsonResponse
    {
        $publish = Publish::findOrFail($id);
        if (AccessPermission::isDelete($request->user()->role_id) ) {
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
        return response()->json($publish->delete(), 204);
    }
}
