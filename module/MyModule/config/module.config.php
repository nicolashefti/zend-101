<?php

namespace MyModule;

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
);