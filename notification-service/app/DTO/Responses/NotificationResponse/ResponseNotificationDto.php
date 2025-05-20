<?php
    namespace App\DTO\Responses\NotificationResponse;

    readonly class ResponseNotificationDto
    {
        public function __construct(
            public string $id,
            public string $status
        ) {}
    }
