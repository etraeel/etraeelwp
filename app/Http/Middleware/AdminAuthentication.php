<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthentication
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
        if($request->user()->is_admin() || $request->user()->is_stuff()){
            return $next($request);
        }
        return redirect('/');
    }
}
