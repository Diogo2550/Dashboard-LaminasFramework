<?php

use Core\Factories\FormElementErrorsFactory;
use Core\Factories\TransportSmtpFactory;
use Laminas\Form\View\Helper\FormElementErrors;

return [
    'service_manager' => [
        'factories' => [
            'core.transport.smtp' => TransportSmtpFactory::class
        ]
    ],
    'view_helpers' => [
        'factories' => [
            FormElementErrors::class => FormElementErrorsFactory::class    
        ]
    ]
];