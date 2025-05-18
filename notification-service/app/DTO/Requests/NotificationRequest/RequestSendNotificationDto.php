<?php
    namespace App\DTO\Requests\NotificationRequest;

    readonly class RequestSendNotificationDto
    {
        public function __construct(
            public string $user_id,
            public string $message,
            public string $channel
        ) {}
    }
