<?php

namespace Abedin\WebInstaller\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotInstalledMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (app()->runningInConsole() || app()->runningUnitTests()) {
            return $next($request);
        }

        if (file_exists(storage_path('installed')) || $this->inExceptArray($request)) {
            return $next($request);
        }

        return redirect()->route('installer.welcome.index');
    }

    /**
     * Keep the installer reachable while avoiding interference with non-installer endpoints.
     * Users can add more exclusions for custom health checks or public routes if needed.
     */
    protected function inExceptArray(Request $request): bool
    {
        $except = config('installer.install_redirect.except', []);

        foreach ($except as $pattern) {
            if ($request->is($pattern)) {
                return true;
            }
        }

        return false;
    }
}
