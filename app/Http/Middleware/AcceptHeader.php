<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Exceptions\AcceptHeaderException;
use Closure;

class AcceptHeader
{
    public function handle($request, Closure $next)
    {
        if (!app()->get('accept')->isAvailableFormat()) {
            throw new AcceptHeaderException('Accept format is not supported');
        }

        return $next($request);
    }
}
