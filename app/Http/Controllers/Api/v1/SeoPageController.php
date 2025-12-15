<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\AccessPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSeoPageRequest;
use App\Http\Requests\UpdateSeoPageRequest;
use App\Http\Resources\SeoPageResource;
use App\Models\SeoPage;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SeoPageController extends Controller
{

    use HelperTrait;
    public function __construct()

    {
        $this->middleware('auth:api', ['only' => ['store','update','destroy']]);

    }
    public function fields(): array
    {

        return [
            modelForm('slug', 'Url'),
            modelForm('title', 'Title'),
            modelFormHide('description', 'Описание','text'),

        ];
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        if ($request->has('paginate')) {

            return SeoPageResource::collection(SeoPage::paginate($request->get('paginate'), ['*'], 'page', $request->get('page') ?? 1));

        } else {
            return SeoPageResource::collection(SeoPage::get());
        }

    }

    /**
     * Store a newly created resource in storage.
     * @param StoreSeoPageRequest $request
     * @return SeoPageResource
     */
    public function store(StoreSeoPageRequest $request): SeoPageResource
    {
        return new SeoPageResource(SeoPage::create($request->validated()));
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return SeoPageResource
     */
    public function show(string $id): SeoPageResource
    {
        return new SeoPageResource(SeoPage::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateSeoPageRequest $request
     * @param string $id
     * @return SeoPageResource
     */
    public function update(UpdateSeoPageRequest $request, string $id): SeoPageResource
    {
        $teacher = SeoPage::findOrFail($id);
        $teacher->update($request->validated());
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
        $teacher = SeoPage::findOrFail($id);
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
        return response()->json($teacher->delete(), 204);
    }
}
