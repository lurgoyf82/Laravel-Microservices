<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Log;
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

            // 5) Build target URL

            if ($parameters) {
                $url = $route['url'] . '/' .$version . '/' . $parameters;
            } else {
                $url = $route['url'] . '/' .$version;
            }

            // 6) Cache

            // 7) Auth

            // 8) Rate limit

            dd('ahio');
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
