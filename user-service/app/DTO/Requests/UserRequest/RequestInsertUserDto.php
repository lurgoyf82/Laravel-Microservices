<?php
    namespace App\DTO\Requests\UserRequest;

    readonly class RequestInsertUserDto
    {
        public function __construct(
            public string $name,
            public string $email,
            public string $password
        ) {}
    }
