<?php
    namespace App\DTO\Requests\AuthRequest;

    readonly class RequestLoginDto
    {
        public function __construct(
            public string $email,
            public string $password
        ) {}
    }
