<?php
    namespace App\DTO\Requests\PaymentRequest;

    readonly class RequestProcessPaymentDto
    {
        public function __construct(
            public string $order_id,
            public float $amount,
            public string $method
        ) {}
    }
