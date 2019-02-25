<?php

namespace App\Http\Middleware;

use Closure;

class IsEmployHr
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
        if (auth()->check() && $request->user()->level == 'Employee' && $request->user()->depart == 'Human Resources'){
            return $next($request);
        }
        return redirect()->guest('/');
    }
}
