<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Factories\JwtProviderFactory;

class JWTMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $header = $request->header('Authorization');
        if (! $header || ! str_starts_with($header, 'Bearer ')) {
            return response()->json(['error' => 'Token assente'], 401);
        }

        $token = substr($header, 7);
        $provider = JwtProviderFactory::make();
        $payload = $provider->validateToken($token);

        if (! $payload) {
            return response()->json(['error' => 'Token non valido o scaduto'], 401);
        }

        // Aggiungi user_id al request per i controller
        $request->attributes->set('jwt_payload', $payload);

        return $next($request);
    }
}
