<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckBusiness
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
        if(Auth::guard('business')->check())
        {
            if(Auth::guard('business')->user()->status != 1){
                return redirect('notAuthorized');
            }
            return $next($request);
        }
            return redirect('login');
    }
}
