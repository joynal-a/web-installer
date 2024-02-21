<?php

namespace Abedin\WebInstaller\Middleware;

use Closure;

class CheckHasConfigMiddleware
{
    protected $except = [
        '/app-configure/{index}'
    ];

    public function handle($request, Closure $next)
    {
        $hasConfigFile = is_file(base_path('config/installer.php'));
        if($hasConfigFile){
            return $next($request);
        }
        return to_route('installer.welcome.index');
    }
}
