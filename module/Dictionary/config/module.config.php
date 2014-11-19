<?php

namespace Dictionary;

return array(

    /*
     * ------------------------------------------------------------------------
     * DOCTRINE
     * ------------------------------------------------------------------------
     */
    'doctrine'        => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => 'Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver',
                'paths' => [
                    __DIR__ . '/../src/Document'
                ],
            ],
            'odm_default'             => [
                'drivers' => [
                    __NAMESPACE__ . '\Document' => __NAMESPACE__ . '_driver'
                ],
            ],
        ],
    ],
    /*
     * ------------------------------------------------------------------------
     * ROUTER
     * ------------------------------------------------------------------------
     */
    'router' => array(
        'routes' => array(
            'dictionary' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/dictionary[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[a-zA-Z0-9_-]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Dictionary\Controller\Dictionary',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    /*
     * ------------------------------------------------------------------------
     * SERVICE MANAGER
     * ------------------------------------------------------------------------
     */
    'service_manager' => array(
        'factories' => array(
            'Dictionary\DictionaryTranslator' =>
                'Dictionary\Service\DictionaryLoaderFactory',
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'Dictionary\Controller\Dictionary' => 'Dictionary\Controller\DictionaryController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'dictionary' => __DIR__ . '/../view',
        ),
        'strategies' => array (
            'ViewJsonStrategy'
        )
    ),
);