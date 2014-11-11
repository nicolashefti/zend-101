<?php

namespace Destination;

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
             'destination' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/destination[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[a-zA-Z0-9_-]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Destination\Controller\Destination',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
    ),

    'controllers' => array(
         'invokables' => array(
             'Destination\Controller\Destination' => 'Destination\Controller\DestinationController',
         ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'desitnation' => __DIR__ . '/../view',
         ),
         'strategies' => array (
             'ViewJsonStrategy' 
         )
     ),
);
