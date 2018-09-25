<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
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
        //Log::info(Auth::user()->role_id);

        if (Auth::user() && $request->user()->role_id == 1 ) {
            return response('Insufficient permissions', 401);
        }

        return $next($request);
    }
}
