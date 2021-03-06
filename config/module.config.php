<?php
namespace GuestUser;

return [
    'entity_manager' => [
        'mapping_classes_paths' => [
            __DIR__ . '/../src/Entity',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'guestUserWidget' => View\Helper\GuestUserWidget::class,
        ],
    ],
    'form_elements' => [
        'factories' => [
            'GuestUser\Form\Config' => Service\Form\ConfigFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            'GuestUser\Controller\Site\GuestUser' => Service\Controller\Site\GuestUserControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            'Omeka\AuthenticationService' => Service\AuthenticationServiceFactory::class,
            'Omeka\Acl' => Service\AclFactory::class,
        ],
    ],
    'navigation_links' => [
        'invokables' => [
            'register' => Site\Navigation\Link\Register::class,
            'login' => Site\Navigation\Link\Login::class,
            'logout' => Site\Navigation\Link\Logout::class,
        ],
    ],
    'navigation' => [
        'site' => [
            [
                'label' => 'User information',
                'route' => '/guest-user/login',
                'resource' => Controller\Site\GuestUserController::class,
                'visible' => true,
            ],
        ],
    ],
    'router' => [
        'routes' => [
            'site' => [
                'child_routes' => [
                    'guest-user' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/guest-user/:action',
                            'defaults' => [
                                '__NAMESPACE__' => 'GuestUser\Controller\Site',
                                'controller' => 'GuestUser',
                            ],
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
                'text_domain' => null,
            ],
        ],
    ],
];
