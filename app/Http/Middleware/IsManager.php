<?php

namespace App\Http\Middleware;

use Closure;

class IsManager
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
        if (auth()->check() && $request->user()->depart == 'BGRC Management' && $request->user()->level == 'Manager'){
            return $next($request);
        }
        return redirect()->guest('/');
    }
}