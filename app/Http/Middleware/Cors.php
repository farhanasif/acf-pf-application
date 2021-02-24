<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class Cors extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function handle($request)
    {
        return $next($request)
               ->header('Access-Control-Allow-Origin','*')
               ->header('Access-Control-Allow-Methods','GET','POST','PUT','OPTIONS')
    }
}
