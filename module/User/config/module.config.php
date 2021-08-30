<?php

namespace User;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use User\Controller\IndexController;
use User\Model\Factory\UserTableFactory;
use User\Model\UserTable;

return [
    'router' => [
        'routes' => [
            'user' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/user',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action' => 'register'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '[/:action][/token/:token]',
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'token' => '[[a-f0-9]{32}]$'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => InvokableFactory::class
        ]
    ],
    'view_manager' => [
        'template_map' => [
            'user/layout/layout' => __DIR__ . '/../view/layout/layout.phtml',

            'user/index/register' => __DIR__ . '/../view/user/index/register.phtml',
            'user/index/recovered-passoword' => __DIR__ . '/../view/user/index/recovered-passoword.phtml',
            'user/index/new-password' => __DIR__ . '/../view/user/index/new-password.phtml',
            'user/index/confirmed-email' => __DIR__ . '/../view/user/index/confirmed-email.phtml',
        ],
        'template_path_stack' => [
            __DIR__.'/../view'
        ]
    ],
    'service_manager' => [
        'factories' => [
            UserTable::class => UserTableFactory::class
        ]
    ]
];