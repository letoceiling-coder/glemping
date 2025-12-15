<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\User\ForgetRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PassportAuthController extends Controller
{

    public function register(RegisterRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $requestData = $request->validated();
        $requestData['password'] = Hash::make($requestData['password']);
        $user = User::create($requestData);

        try {


            $authToken = 'authToken';

            $accessToken = $user->createToken($authToken)->accessToken;
            return response([
                'user' => new UserResource($user),
                'accessToken' => $accessToken,
                'response' => [
                    'title' => 'Успешно',
                    'text' => 'Вы успешно зарегистрировались',
                    'status' => 'success',
                ]
            ]);
        }
        catch (\Exception $exception){

            return response([
                'user' => $user->delete(),
                'accessToken' => null,
                'response' => [
                    'title' => 'Что то пошло не так',
                    'text' => 'Произошла ошибка на сервере',
                    'status' => 'error',
                ]
            ]);
        }



    }
    public function update(UpdateUserRequest $request)
    {
        $data = $request->validated();
        if ($request->get('password')){
            $data['password'] = Hash::make($data['password']);
        }
        $request->user()->update($data);
        return new UserResource(User::find($request->user()->id));
    }

    public function login(LoginRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $requestData = $request->validated();

        if (!auth()->attempt($requestData)) {
            return response()->json([
                'error' => 'UnAuthorised Access',
                'notify' => [
                    'title' => 'Доступ запрещен',
                    'text' => 'Не верный логин или пароль',
                    'type' => 'error',
                ]
            ], 401);
        }

        $user = auth()->user();
        $authToken = 'authToken';

        $accessToken = $user->createToken($authToken)->accessToken;

        return response([
            'user' => auth()->user(),
            'accessToken' => $accessToken,
            'notify' => [
                'title' => 'Успешно',
                'text' => 'Авторизован',
                'status' => 'success',
            ]], 200);
    }

    public function forgetToken(ForgetRequest $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {

        return (new ForgotPasswordController())->sendResetLinkEmail($request);

    }

    public function user(): \Illuminate\Http\JsonResponse
    {

        $user = auth()->user();

        return response()->json(['user' => $user]);
    }

    public function logout(Request $request)
    {

        $token = $request->user()->token();
        $token->revoke();

        return response(['notify' => [
            'title' => 'Успешно',
            'text' => 'Вы успешно вышли из системы',
            'status' => 'success',
        ]], 200);
    }
}
