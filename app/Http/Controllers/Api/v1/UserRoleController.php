<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\AccessPermission;
use App\Helpers\Email\Notification;
use App\Http\Controllers\Controller;
use App\Http\Filters\UserFilter;
use App\Http\Filters\UserRoleFilter;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreUserRoleRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Http\Resources\UserRoleResource;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserRoleController extends Controller
{

    use HelperTrait;

    public function fields(): array
    {

        return [
            modelForm('name', 'Имя '),
            modelForm('description', 'Описание'),
            modelFormHide('system', 'Системный','system'),
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

        $filter = app()->make(UserRoleFilter::class, ['queryParams' => array_filter($request->all())]);

        if ($request->has('paginate')) {

            return UserRoleResource::collection(UserRole::filter($filter)->paginate($request->get('paginate'), ['*'], 'page', $request->get('page') ?? 1));

        } else {
            return UserRoleResource::collection(UserRole::filter($filter)->get());
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreUserRoleRequest $request
     * @return UserRoleResource
     */
    public function store(StoreUserRoleRequest $request): UserRoleResource
    {
        $data = $request->validated();

        return new UserRoleResource(UserRole::create($data));
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return UserRoleResource()
     */
    public function show(string $id): UserRoleResource
    {
        return new UserRoleResource(UserRole::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRoleRequest $request
     * @param string $id
     *
     */
    public function update(UpdateUserRoleRequest $request, string $id): UserRoleResource|\Illuminate\Http\JsonResponse
    {

        $user_role = UserRole::findOrFail($id);
        if (AccessPermission::isDelete($request->user()->role_id) || $user_role->system) {
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
        $user_role->update($request->validated());
        return new UserRoleResource($user_role);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request , string $id): \Illuminate\Http\JsonResponse
    {
        $user_role = UserRole::findOrFail($id);
        if (AccessPermission::isDelete($request->user()->role_id) || $user_role->system) {
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
        return response()->json($user_role->delete(), 204);
    }
}
