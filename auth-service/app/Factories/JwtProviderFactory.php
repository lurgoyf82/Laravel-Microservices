<?php

namespace App\Factories;

use App\Interfaces\IJwtProvider;
use App\Services\TymonJwtProvider;
use Tymon\JWTAuth\JWTAuth;

class JwtProviderFactory
{
    /**
     * Restituisce un'istanza concreta di IJwtProvider
     *
     * @return IJwtProvider
     */
    public static function make(): IJwtProvider
    {
        // Laravel container risolverà JWTAuth automaticamente
        $jwt = app(JWTAuth::class);
        return new TymonJwtProvider($jwt);
    }
}
