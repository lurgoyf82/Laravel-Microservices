<?php
    namespace App\DTO\Responses\UserResponse;

    readonly class ResponseUserDto
    {
        public function __construct(
            public string $name,
            public string $email,
            public string $password
        ) {}
    }
