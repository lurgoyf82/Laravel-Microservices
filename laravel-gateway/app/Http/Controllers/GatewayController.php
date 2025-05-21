<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\RateLimiter;
    use Symfony\Component\HttpFoundation\Response;

    class GatewayController extends Controller
    {
        protected $gateway_routes;
        public function __construct()
        {
            // 1) Middleware to validate and extract config
            $this->gateway_routes = require config_path('gateway_routes.php');
        }

        public function proxy(Request $request, string $version, string $service=null, string $parameters = null) {
            // 4) Build target URL
            $route = false;
            if (array_key_exists($service, $this->gateway_routes)) {
                $route = $this->gateway_routes[$service];
            }
            if (!$route) {
                return response()->json(['error' => 'Service not found'], Response::HTTP_NOT_FOUND);
            }

            // 4.1) Method allowed check
            $allowed = $route['allowed_methods'] ?? [];
            if ($allowed && !in_array($request->method(), $allowed)) {
                return response()->json(['error' => 'Method Not Allowed'], Response::HTTP_METHOD_NOT_ALLOWED);
            }

            // 5) Build target URL
            $url  = $route['url']."/{$service}/{$version}";
            if ($parameters) {
                $url .= "/{$parameters}";
            }

            // 6) Rate limit
            $key = $service.'|'.$request->ip();
            if (RateLimiter::tooManyAttempts($key, (int)$route['rate_limit'])) {
                return response()->json(['error' => 'Too Many Requests'], Response::HTTP_TOO_MANY_REQUESTS);
            }
            RateLimiter::hit($key);

            // 7) Auth
            if ($route['auth'] && !$request->bearerToken()) {
                return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            }

            // 8) Cache

            //the service name, the version and the parameters should be json encoded and then hashed into a single unique key
            //also are the user and the authorizations and authentications important to the cache ?


            if ($route['cache_ttl'] > 0) {
                $cache_key = md5('gateway_'.json_encode($service, $version, $parameters));
                $cached_response = Cache::get($cache_key);
                if ($cached_response) {
                    return response($cached_response->body(), $cached_response->status())
                        ->withHeaders($cached_response->headers());
                }
            }

            // 9) Forward request
            $response = Http::withHeaders($request->headers->all())
                ->send($request->method(), $url, [
                    'query' => $request->query(),
                    'body' => $request->getContent(),
                ]);

            /*
            // 10) Return response
            if (!$response || !$response->successful()) {
                return response()->json(['error' => 'Failed to forward request'], Response::HTTP_BAD_GATEWAY);
            }
            */

            return response($response->body(), $response->status())
                ->withHeaders($response->headers());


        }
    }
