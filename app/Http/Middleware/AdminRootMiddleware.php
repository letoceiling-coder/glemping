<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


use Symfony\Component\HttpFoundation\Response;

class AdminRootMiddleware
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

        if ($request->user() && $request->user()->email === 'dsc-23@yandex.ru') {
            return $next($request);
        }
        return response()->json(['error' => "Access denied"], 403);

    }


}
