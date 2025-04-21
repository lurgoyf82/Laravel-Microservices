<?php

namespace App\Interfaces;

interface IJwtProvider
{
    /**
     * Emissione di un nuovo token per l'utente dato.
     *
     * @param  \App\Models\User  $user
     * @return string JWT token
     */
    public function issueToken($user): string;

    /**
     * Validazione del token JWT e recupero dei payload.
     *
     * @param  string  $token
     * @return array|null Payload se valido, null altrimenti
     */
    public function validateToken(string $token): ?array;

    /**
     * Refresh del token JWT.
     *
     * @param  string  $token
     * @return string Nuovo JWT token
     */
    public function refreshToken(string $token): string;
}
