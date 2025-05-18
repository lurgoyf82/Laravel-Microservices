<?php
    namespace App\DTO\Responses\AuthResponse;

    readonly class ResponseAuthTokenDto
    {
        public function __construct(
            public string $token,
            public int $expires_in
        ) {}
    }
