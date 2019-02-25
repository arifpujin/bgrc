<?php

namespace App\Http\Middleware;

use Closure;

class IsHodHr
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
        if (auth()->check() && $request->user()->level == 'HOD' && $request->user()->depart == 'Human Resources'){
            return $next($request);
        }
        return redirect()->guest('/');
    }
}
