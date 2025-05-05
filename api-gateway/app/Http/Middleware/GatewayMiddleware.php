<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Services\GatewayConfigService;


class GatewayMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $configService = app(GatewayConfigService::class);
        $uri = $request->path();

        // 1. Matching della rotta
        $route = $configService->matchRoute($uri);
        if (! $route) {
            return response()->json(['error' => 'Route not found'], 404);
        }

        // 2. Controllo autenticazione (se richiesto)
        if ($route['auth_required'] && ! $request->bearerToken()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // 3. Rate limiting
        $limit = (int) $route['rate_limit'];
        $key   = Str::slug($route['id']) . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, $limit)) {
            return response()->json(['error' => 'Too Many Requests'], 429);
        }
        RateLimiter::hit($key);

        // 4. Correlation ID
        $requestId = Str::uuid()->toString();
        $request->headers->set('X-Request-ID', $requestId);

        // 5. Passaggio config al controller
        $request->attributes->set('gateway_route', $route);

        return $next($request);
    }
}
