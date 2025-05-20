<?php
    namespace App\Services;

    use Illuminate\Support\Facades\Cache;

    class CacheManager
    {
        public function fetch(string $key): ?array
        {
            return Cache::store('redis')->get($key);
        }

        public function store(string $key, array $payload, int $ttl): void
        {
            Cache::store('redis')->put($key, $payload, $ttl);
        }
    }
