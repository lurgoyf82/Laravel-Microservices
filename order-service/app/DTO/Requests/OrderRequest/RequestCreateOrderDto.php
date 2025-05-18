<?php
    namespace App\DTO\Requests\OrderRequest;

    readonly class RequestCreateOrderDto
    {
        public function __construct(
            public string $user_id,
            public array $items,
            public float $total
        ) {}
    }
