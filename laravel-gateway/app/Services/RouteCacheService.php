<?php

namespace App\Services;

use App\Models\GatewayRoute;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class RouteCacheService
{
    const CACHE_KEY = 'gateway_routes_config';

    /**
     * Load active routes from DB and store them in Redis cache.
     */
    public function loadRoutesToCache(): array
    {
        Log::info('Loading gateway routes from database to cache...');
        try {
            $routes = GatewayRoute::where('is_active', true)
                ->pluck('target_service_url', 'gateway_prefix')
                ->toArray();

            // Use 'forever' for persistence via Redis, assuming Redis persistence is on.
            Cache::store('redis')->forever(self::CACHE_KEY, $routes);
            Log::info('Gateway routes cached successfully.', ['count' => count($routes)]);
            return $routes;
        } catch (\Exception $e) {
            Log::error('Failed to load gateway routes to cache: ' . $e->getMessage());
            // Return empty array or throw exception depending on desired handling
            return [];
        }
    }

    /**
     * Get routes from cache, loading from DB if necessary.
     */
    public function getRoutes(): array
    {
        $routes = Cache::store('redis')->get(self::CACHE_KEY);

        if (is_null($routes)) {
            Log::warning('Gateway routes cache miss. Reloading from database.');
            $routes = $this->loadRoutesToCache();
        }

        // Ensure it's always an array, even if loading failed
        return is_array($routes) ? $routes : [];
    }

    /**
     * Clear the routes cache.
     */
     public function clearCache(): void
     {
         Cache::store('redis')->forget(self::CACHE_KEY);
         Log::info('Gateway routes cache cleared.');
     }
}
