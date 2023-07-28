<?php

namespace App\Http\Middleware;

use Closure;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$access)
    {
        if(!auth()->user()->has_permissions()->contains($access) && !auth()->user()->is_admin() ){
            abort(401);
        }

        return $next($request);
    }
}
