<?php

namespace App\Http\Middleware;

use App\Exceptions\AcceptHeaderException;
use Closure;

class AcceptHeader
{
    public function handle($request, Closure $next)
    {
        if (!app()->get('accept')->isAvailableFormat($request)) {
            throw new AcceptHeaderException('Accept format is not supported');
        }

        return $next($request);
    }
}
