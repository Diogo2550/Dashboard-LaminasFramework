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
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ]
    ],
];