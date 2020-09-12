<?php

namespace App\Http\Middleware;

use Closure;

class AcceptHeader
{
    public function handle($request, Closure $next)
    {
        if (!app()->get('accept')->isAvailableFormat($request)) {
            return response()->json([], 406);
        }

        return $next($request);
    }
}
