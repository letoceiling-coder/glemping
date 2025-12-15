<?php

namespace App\Http\Middleware;



use App\Helpers\Settings\SettingSite;


use Closure;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class IsRoleAdminMiddleware
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

       if($request->user() && $request->user()->role_id > 1){
           return $next($request);
       }
        return redirect('/personal');

    }


}
