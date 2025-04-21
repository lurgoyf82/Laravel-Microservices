<?php

namespace App\Services;

use App\Interfaces\IJwtProvider;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class TymonJwtProvider implements IJwtProvider
{
    protected JWTAuth $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function issueToken($user): string
    {
        try {
            return $this->jwt->fromUser($user);
        } catch (JWTException $e) {
            // Gestione dell'eccezione in conformità con SRP
            throw new \RuntimeException('Impossibile emettere token JWT');
        }
    }

    public function validateToken(string $token): ?array
    {
        try {
            $payload = $this->jwt->setToken($token)->getPayload();
            return $payload->toArray();
        } catch (JWTException $e) {
            return null;
        }
    }

    public function refreshToken(string $token): string
    {
        try {
            return $this->jwt->setToken($token)->refresh();
        } catch (JWTException $e) {
            throw new \RuntimeException('Impossibile eseguire refresh token JWT');
        }
    }
}
