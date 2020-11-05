<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles) // esta forma me trae solo los parametros q le paso en el middleware web
    {
        //Call to custom hasRole function
        foreach ($roles as $role) {
            if ( auth()->user()->hasRole($role) ) {
                return $next($request);
            }
        }

        return abort(403);
    }
}
