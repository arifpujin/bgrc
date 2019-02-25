<?php

namespace App\Http\Middleware;

use Closure;

class IsEmploy
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
        if (auth()->check() && $request->user()->level == 'Employee'){
            return $next($request);
        }
        if (auth()->check() && $request->user()->level == 'Student'){
            return $next($request);
        }
        return redirect()->guest('/');
    }
}
