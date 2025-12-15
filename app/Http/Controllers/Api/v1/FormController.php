<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\AccessPermission;
use App\Http\Controllers\Controller;
use App\Http\Filters\FormFilter;
use App\Http\Requests\StoreFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Http\Resources\FormResource;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    use HelperTrait;
    public function __construct()

    {
        $this->middleware('auth:api', ['only' => ['store','update','destroy']]);

    }

    public function fields(): array
    {

        return collect([
            addForm('name', 'Наименование')->sort(1)->send(),
            addForm('method', 'Метод')->sort(2)->send(),
            addForm('data', 'DATA')->hide()->send(),
            addForm('active', 'Активность ')->active()->send(),
            addForm('sort', 'Сортировка ')->integer()->send(),

        ])->toArray();
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     *
     */
    public function index(Request $request)
    {
        $filter = app()->make(FormFilter::class, ['queryParams' => array_filter($request->all())]);
        if ($request->has('paginate')) {

            return FormResource::collection(Form::filter($filter)->paginate($request->get('paginate'), ['*'], 'page', $request->get('page') ?? 1));

        } else {
            return FormResource::collection(Form::filter($filter)->get());
        }

    }

    /**
     * Store a newly created resource in storage.
     * @param StoreFormRequest $request
     * @return FormResource
     */
    public function store(StoreFormRequest $request): FormResource
    {
        return new FormResource(Form::create($request->validated()));
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return FormResource
     */
    public function show(string $id): FormResource
    {
        return new FormResource(Form::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateFormRequest $request
     * @param string $id
     * @return FormResource
     */
    public function update(UpdateFormRequest $request, string $id): FormResource
    {
        $form = Form::findOrFail($id);
        $form->update($request->validated());
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
        $form = Form::findOrFail($id);
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
        return response()->json($form->delete(), 204);
    }
}
