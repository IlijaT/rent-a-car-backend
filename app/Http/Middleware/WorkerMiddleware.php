<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class WorkerMiddleware
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
        if (Auth::user() && !$request->user()->hasAnyRoles(['Admin', 'Owner', 'Worker'])) {
            return response('Insufficient permissions', 401);
        }

        return $next($request);
    }
}
