<?php
return array(
    'ZucchiLocale' => array(
        'locale' => array(
            'handlers' => array(),
            'allowed' => array(),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'zucchi-locale-admin' => 'ZucchiLocale\Controller\AdminController',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'tranzlate' => 'ZucchiLocale\View\Helper\Tranzlate',
        ),
    ),
    'navigation' => array(
        'ZucchiAdmin' => array(
            'settings' => array(
                'pages' => array(
                    'locale' => array(
                        'label' => _('Locale'),
                        'route' => 'ZucchiAdmin/ZucchiLocale',
                        'action' => 'settings',
                    ),
                )
            )
        )
    ),
    // default route 
    'router' => array(
        'routes' => array(
            'ZucchiAdmin' => array(
                'child_routes' => array(
                    'ZucchiLocale' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => '/locale[/:action]',
                            'defaults' => array(
                                'module' => 'ZucchiLocale',
                                'controller' => 'zucchi-locale-admin',
                                'action' => null,
                            ),
                        ),
                        'may_terminate' => true,
                    ),
                    
                ),
            ),
        ),
    ),
    'translator' => array(
        'locale' => 'en_GB',
        'translation_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'ZucchiLocale' => __DIR__ . '/../view',
        ),
    ),
    'ZucchiSecurity' => array(
        'permissions' => array(
            'resources' => array(
                'route' =>array(
                    'ZucchiAdmin' => array(
                        'children' => array('ZucchiLocale'),
                    )
                ),
            ),
        ),
    ),
    'ZucchiSecurity' => array(
        'permissions' => array(
            'map' => array(
                'ZucchiLocale' => array(
                    'settings' => 'update',
                ),
            ),
            'roles' => array(
                'locale-manager' => array(
                    'label' => 'Locale Manager (ability to update locale settings)',
                ),
            ),
            'resources' => array(
                'route' =>array(
                    'ZucchiAdmin' => array(
                        'children' => array('ZucchiLocale'),
                    ),
                ),
                'module' => array(
                    'ZucchiLocale',
                )
            ),
            'rules' => array(
                array(
                    'role' => 'locale-manager',
                    'resource' => array(
                        'route:ZucchiAdmin/ZucchiLocale',
                        'module:ZucchiLocale',
                    ),
                    'privileges' => array(
                        'view','update',
                    ),
                ),
            ),
        ),
    ),
);