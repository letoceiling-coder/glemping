<?php

namespace App\Http\Middleware;



use App\Helpers\Settings\SettingSite;


use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next (\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response
     */




    public function handle(Request $request, Closure $next): Response
    {

        if ($request->getHost() == 'xn--80adpvgf4a.xn--p1ai' || $request->getHost() == 'www.xn--80adpvgf4a.xn--p1ai') {

            return redirect()->to('https://povuzam.ru/');
        }
        if (Str::contains($request->path(),'password/reset/')){
            if (DB::table('password_reset_tokens')->where('email',request()->input('email'))->first()?->token){
                if (Hash::check(str_replace('password/reset/','',request()->path()), DB::table('password_reset_tokens')->where('email',request()->input('email'))->first()->token)){

                    $user = User::firstWhere('email',request()->input('email'));
                    Auth::loginUsingId($user->id);
                    $authToken = 'authToken';
                    $accessToken = $user->createToken($authToken)->accessToken;

                    DB::table('password_reset_tokens')->where('email',request()->input('email'))->delete();
                    return redirect()->to('/personal');
                }

            }

        }
        $settings = (new SettingSite())->settings();

        View::composer('*', function ($view) use ($settings) {
            $view->with(['settings' => $settings]);
        });

        return $next($request);
    }


}
