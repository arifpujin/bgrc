<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if (auth()->check() && $request->user()->username == 'admin' && $request->user()->level == 'Admin SistemExitPass'){
            return $next($request);
        }
        return redirect()->guest('/');
    }
}
