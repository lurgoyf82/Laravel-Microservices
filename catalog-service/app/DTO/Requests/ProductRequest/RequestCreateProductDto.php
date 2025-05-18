<?php
    namespace App\DTO\Requests\ProductRequest;

    readonly class RequestCreateProductDto
    {
        public function __construct(
            public string $name,
            public ?string $description,
            public float $price
        ) {}
    }
