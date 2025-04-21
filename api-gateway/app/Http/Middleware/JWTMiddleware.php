<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Verifica token JWT e recupera utente
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            return new JsonResponse([
                'error' => 'Token non valido o scaduto'
            ], 401);
        }

        // Aggiunge l'utente al request per i controller interni
        $request->attributes->add(['auth_user' => $user]);

        return $next($request);
    }
}
