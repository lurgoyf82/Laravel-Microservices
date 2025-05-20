<?php
    namespace App\DTO\Requests\UserRequest;

    readonly class RequestDeleteUserDto
    {
        public function __construct(
            public string $idUser
        ) {}
    }
