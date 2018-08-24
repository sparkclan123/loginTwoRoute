<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
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
        // if( ! auth()->user()->isAdmin )
        // {
        //     auth()->user()->logout();
        //     return redirect('/login')
        // }
        return $next($request);
    }
}
