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
    'service_manager' => array(
        'factories' => array(
            'ZucchiLocale\Handler\Query' => function($sm) {
                $handler = new ZucchiLocale\Handler\Query();
                $config = $sm->get('config')['ZucchiLocale']['locale'];
                $handler->setConfig($config);
                return $handler;
            },
            'ZucchiLocale\Handler\Route' => function($sm) {
                $handler = new ZucchiLocale\Handler\Route();
                $config = $sm->get('config')['ZucchiLocale']['locale'];
                $handler->setConfig($config);
                return $handler;
            },
            'ZucchiLocale\Handler\Host' => function($sm) {
                $handler = new ZucchiLocale\Handler\Host();
                $config = $sm->get('config')['ZucchiLocale']['locale'];
                $handler->setConfig($config);
                return $handler;
            },
            'ZucchiLocale\Handler\Cookie' => function($sm) {
                $handler = new ZucchiLocale\Handler\Cookie();
                $config = $sm->get('config')['ZucchiLocale']['locale'];
                $handler->setConfig($config);
                return $handler;
            },
            'ZucchiLocale\Handler\Session' => function($sm) {
                $handler = new ZucchiLocale\Handler\Session();
                $config = $sm->get('config')['ZucchiLocale']['locale'];
                $handler->setConfig($config);
                return $handler;
            },
            'ZucchiLocale\Handler\Header' => function($sm) {
                $handler = new ZucchiLocale\Handler\Header();
                $config = $sm->get('config')['ZucchiLocale']['locale'];
                $handler->setConfig($config);
                return $handler;
            },
        ),
    ),
    'navigation' => array(
        'ZucchiAdmin' => array(
            'locale' => array(
                'label' => _('Locale'),
                'route' => 'ZucchiAdmin/ZucchiLocale',
                'action' => 'settings',
            ),
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
);