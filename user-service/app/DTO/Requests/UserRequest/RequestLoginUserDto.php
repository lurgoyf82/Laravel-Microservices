<?php
    namespace App\DTO\Requests\UserRequest;

    readonly class RequestLoginUserDto
    {
        public function __construct(
            public string $email,
            public string $password
        ) {}
    }
