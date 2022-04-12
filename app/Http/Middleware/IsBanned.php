<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsBanned
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
        if (Auth::user()->isBaned == 1){
            Auth::logout();
            return redirect()->route('login')->with("alert",["icon"=>"error","title"=>"You Are Banned","message"=>"Please contact Admin"]);
        }
        return $next($request);
    }
}
