<?php

    declare(strict_types=1);

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\RateLimiter;
    use Illuminate\Support\Str;
    use App\Services\GatewayConfigService;
    use Illuminate\Support\Facades\Log;

    class GatewayMiddleware
    {
        /**
         * Handle an incoming request.
         * Extracts service and suffix from route parameters,
         * applies auth, rate limit, and injects gateway_config attribute.
         */
        public function handle(Request $request, Closure $next)
        {
            // Extract route parameters
            $service = $request->route('service');
            $suffix  = $request->route('path') ?? '';

            // Validate service parameter
            if (! is_string($service) || $service === '') {
                return response()->json(['error' => 'Service not specified'], 400);
            }

            // Fetch gateway config for this service
            $configService = app(GatewayConfigService::class);
            $config = $configService->getRoute($service);

            if (is_null($config)) {
                return response()->json(['error' => 'Route not found'], 404);
            }

            // Authentication check
            if ($config['auth'] === true && ! $request->bearerToken()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Rate limiting
            $limit = (int) $config['rate_limit'];
            $key   = Str::slug($service) . '|' . $request->ip();
            if (RateLimiter::tooManyAttempts($key, $limit)) {
                return response()->json(['error' => 'Too Many Requests'], 429);
            }
            RateLimiter::hit($key);

            // Correlation ID header
            $requestId = Str::uuid()->toString();
            $request->headers->set('X-Request-ID', $requestId);

            // Attach config and suffix to request for controller
            $request->attributes->set('gateway_config', [
                'service'   => $service,
                'suffix'    => $suffix,
                'target'    => $config['target'],
                'cache_ttl' => $config['cache_ttl'],
                'auth'      => $config['auth'],
                'rate_limit'=> $config['rate_limit'],
            ]);

            return $next($request);
        }
    }
