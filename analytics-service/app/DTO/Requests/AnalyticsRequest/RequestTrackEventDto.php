<?php
    namespace App\DTO\Requests\AnalyticsRequest;

    readonly class RequestTrackEventDto
    {
        public function __construct(
            public string $event_name,
            public ?string $user_id,
            public ?array $properties
        ) {}
    }
