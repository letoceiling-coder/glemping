<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\AccessPermission;
use App\Helpers\Email\Notification;
use App\Http\Controllers\Controller;
use App\Http\Filters\UserFilter;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{

    use HelperTrait;

    public function fields()
    {

        return [
            modelForm('name', 'Имя '),
            modelForm('email', 'email'),
            modelForm('phone', 'Телефон'),
            modelForm('password', 'Пароль'),
            modelForm('subscription', 'Подписка ','active'),
            modelForm('active', 'Активность ','active'),
            modelForm('role_id', 'роль ', 'select', true, UserRole::select(['id', 'name'])->get()->toArray()),
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

        $filter = app()->make(UserFilter::class, ['queryParams' => array_filter($request->all())]);

        if ($request->has('paginate')) {

            return UserResource::collection(User::filter($filter)->paginate($request->get('paginate'), ['*'], 'page', $request->get('page') ?? 1));

        } else {
            return UserResource::collection(User::filter($filter)->get());
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreUserRequest $request
     */
    public function store(StoreUserRequest $request): UserResource
    {
        $data = $request->validated();
        $data['password'] = Hash::make(Str::random(16));
        Notification::sendPassword($data);
        return new UserResource(User::create($data));
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return UserResource
     */
    public function show(string $id): UserResource
    {
        return new UserResource(User::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateUserRequest $request
     * @param string $id
     */
    public function update(UpdateUserRequest $request, string $id)
    {

        $user = User::findOrFail($id);
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
        $user->update($request->validated());
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request,string $id): \Illuminate\Http\JsonResponse
    {
        $user = User::findOrFail($id);
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
        return response()->json($user->delete(), 204);
    }
}
