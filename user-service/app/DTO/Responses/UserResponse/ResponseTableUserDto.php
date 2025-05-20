<?php
    namespace App\DTO\Responses\UserResponse;

    readonly class ResponseTableUserDto
    {
        public function __construct(
            public int $page,
            public int $pageSize,
            public int $totalCount,
            public int $totalPages,
            public array $users
        ) {}
    }
