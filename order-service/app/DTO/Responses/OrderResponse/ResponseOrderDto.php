<?php
    namespace App\DTO\Responses\OrderResponse;

    readonly class ResponseOrderDto
    {
        public function __construct(
            public string $id,
            public string $user_id,
            public array $items,
            public float $total,
            public string $status
        ) {}
    }
