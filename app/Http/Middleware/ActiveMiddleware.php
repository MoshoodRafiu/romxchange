<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ActiveMiddleware
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
        if (Auth::user()->is_active == 1){
            return $next($request);
        }

        Auth::guard()->logout();
        return redirect('/login')->with('error', 'This account is restricted due to some reasons, contact the Admin for help');
    }
}
