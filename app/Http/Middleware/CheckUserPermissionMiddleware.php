<?php

namespace App\Http\Middleware;

use App\Post;
use Closure;

class CheckUserPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!check_user_permission($request)) {
            abort(401,'You are not authorized to perform this action !');
        }
        return $next($request);
    }
}
