<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class roleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url = $request->path();
        //$role = Auth::user()->role;
        $role = 2;
        $query = "SELECT * FROM (
            SELECT mp.menu_id AS link_id, m.route, m.name
            FROM menu_permissions mp
            INNER JOIN menu m
            ON mp.menu_id = m.id
            WHERE mp.role_id = ".$role."
            AND mp.is_menu = 1
            UNION
            SELECT mp.submenu_id AS link_id,m.route, m.sub_menu_name as name
            FROM menu_permissions mp
            INNER JOIN sub_menu m
            ON mp.submenu_id = m.id
            WHERE mp.role_id = ".$role."
            AND mp.is_menu = 0
            ) AS t WHERE    '".$url."' LIKE CONCAT('%', t.route, '%')";
        $result = DB::select($query);
        if($result){
            return $next($request);
        }
        else{
            return redirect('/');
        }

        //  if (Auth::check() && Auth::user()->role==1 ) {
        //     return $next($request);
        // }
        //return redirect('/');
    }
}
