<?php
    namespace App\DTO\Responses\AnalyticsResponse;

    readonly class ResponseAcknowledgementDto
    {
        public function __construct(
            public string $event_id,
            public bool $received
        ) {}
    }
