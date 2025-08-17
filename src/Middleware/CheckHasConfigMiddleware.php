<?php

namespace Abedin\WebInstaller\Middleware;

use Closure;

class CheckHasConfigMiddleware
{
    public function handle($request, Closure $next)
    {
        $hasConfigFile = is_file(base_path('config/installer.php'));
        $isInstalled = is_file(public_path('installed'));

        // If installed, block installer routes
        if ($isInstalled) {
            // Redirect to home or any other route you want after install
            return redirect('/');
        }

        // If config exists, allow installer
        if ($hasConfigFile) {
            return $next($request);
        }
        // Otherwise, redirect to installer welcome
        return to_route('installer.welcome.index');
    }
}
