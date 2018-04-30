<?php

namespace App\Http\Middleware;

use Closure;

class CheckFirstLogin
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

        if(auth()->check() && auth()->guard()->user()->firstLogin){
            return redirect('/resetPassword');
        }

        return $next($request);
    }
}
