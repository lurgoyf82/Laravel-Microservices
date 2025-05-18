<?php
    namespace App\DTO\Requests\AuthRequest;

    readonly class RequestRegisterDto
    {
        public function __construct(
            public string $name,
            public string $email,
            public string $password
        ) {}
    }
