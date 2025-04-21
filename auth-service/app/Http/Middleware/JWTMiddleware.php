<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Factories\JwtProviderFactory;

class JWTMiddleware
{
    /**
     * Handle an incoming request by validating the JWT token in the Authorization header.
     *
     * @param  \Illuminate\Http\Request  $request  The incoming HTTP request.
     * @param  \Closure  $next  The next middleware to call.
     * @return \Symfony\Component\HttpFoundation\Response  The HTTP response.
     */
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
