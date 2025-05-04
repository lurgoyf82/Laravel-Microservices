<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class GatewayController extends Controller
{
    public function proxy(Request $request, string $path = ''): Response
    {
        $route    = $request->attributes->get('gateway_route');
        $baseUrl  = rtrim($route['target_service_url'], '/');
        $url      = $baseUrl . '/' . $path;

        // Header da inoltrare (white-list)
        $allowed        = ['Accept', 'Content-Type', 'Authorization', 'X-Request-ID', 'User-Agent'];
        $forwardHeaders = [];
        foreach ($request->headers->all() as $key => $values) {
            $name = implode('-', array_map('ucfirst', explode('-', $key)));
            if (in_array($name, $allowed)) {
                $forwardHeaders[$name] = implode(', ', $values);
            }
        }

        // Caching per GET
        $cacheTtl = (int) $route['cache_ttl'];
        $cacheKey = 'gateway|' . md5($request->fullUrl());
        if ($request->isMethod('get') && $cacheTtl > 0) {
            if ($cached = Cache::store('redis')->get($cacheKey)) {
                return response($cached['body'], $cached['status'])
                    ->withHeaders($cached['headers']);
            }
        }

        try {
            $response = Http::withHeaders($forwardHeaders)
                ->withBody($request->getContent(), $request->header('Content-Type', 'application/json'))
                ->send($request->method(), $url, [
                    'query' => $request->query(),
                ]);

            $body       = $response->body();
            $status     = $response->status();
            $respHeaders = collect($response->headers())
                ->except(['transfer-encoding', 'connection'])
                ->toArray();

            // salva in cache se GET
            if ($request->isMethod('get') && $cacheTtl > 0) {
                Cache::store('redis')->put($cacheKey, [
                    'body'    => $body,
                    'status'  => $status,
                    'headers' => $respHeaders
                ], $cacheTtl);
            }

            return response($body, $status)->withHeaders($respHeaders);

        } catch (\Exception $e) {
            Log::error('Gateway proxy error', ['url' => $url, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Service Unavailable'], 503);
        }
    }
}

