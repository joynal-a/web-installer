<?php

namespace Abedin\WebInstaller\Middleware;

use Closure;

class IsPublisConfigMiddleware
{
    public function handle($request, Closure $next)
    {

        return $next($request);
    }
}
