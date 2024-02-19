<?php

namespace YourPackage\Middleware;

use Closure;

class IsPublisConfigMiddleware
{
    public function handle($request, Closure $next)
    {

        return $next($request);
    }
}
