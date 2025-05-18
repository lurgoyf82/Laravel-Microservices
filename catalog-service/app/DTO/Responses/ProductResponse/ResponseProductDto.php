<?php
    namespace App\DTO\Responses\ProductResponse;

    readonly class ResponseProductDto
    {
        public function __construct(
            public string $id,
            public string $name,
            public ?string $description,
            public float $price
        ) {}
    }
