<?php

use Core\Factories\TransportSmtpFactory;

return [
    'service_manager' => [
        'factories' => [
            'core.transport.smtp' => TransportSmtpFactory::class
        ]
    ]
];