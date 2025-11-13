<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Force HTTPS redirect in production or when APP_URL uses HTTPS
        if (config('app.env') === 'production' || (config('app.url') && str_starts_with(config('app.url'), 'https://'))) {
            if (!$request->secure() && !$request->is('health') && !$request->is('up')) {
                return redirect()->secure($request->getRequestUri(), 301);
            }
        }

        return $next($request);
    }
}

