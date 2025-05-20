<?php
    namespace App\DTO\Responses\PaymentResponse;

    readonly class ResponsePaymentDto
    {
        public function __construct(
            public string $id,
            public string $order_id,
            public float $amount,
            public string $status
        ) {}
    }
