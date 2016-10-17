<?php

namespace CentralCondo\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PortalMiddleware
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
        if(!Auth::user()->id){
            return redirect('auth.login');
        }

        return $next($request);
    }
}
