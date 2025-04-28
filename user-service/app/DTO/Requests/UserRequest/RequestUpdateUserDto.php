<?php
    namespace App\DTO\Requests\UserRequest;

    readonly class RequestUpdateUserDto
    {
        public function __construct(
            public string $idUser,
            public string $name,
            public string $email,
            public string $password
        ) {}
    }
