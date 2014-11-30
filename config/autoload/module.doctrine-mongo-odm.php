<?php
# MONGOSOUP_URL=mongodb://CfkFuuHDpsMc:bfXRhiEmsIXB@mongosoup-shared-db005.mongosoup.de:30425/cc_CfkFuuHDpsMc
return array(
    'doctrine' => array(

        'connection' => array(
            'odm_default' => array(
                'server'           => 'mongosoup-shared-db005.mongosoup.de',
                'port'             => '30425',
                'connectionString' => null,
                'user'             => 'CfkFuuHDpsMc',
                'password'         => 'bfXRhiEmsIXB',
                'dbname'           => 'cc_CfkFuuHDpsMc',
                'options'          => array()
            ),
        ),

        'configuration' => array(
            'odm_default' => array(
                'metadata_cache'     => 'array',

                'driver'             => 'odm_default',

                'generate_proxies'   => true,
                'proxy_dir'          => 'data/DoctrineMongoODMModule/Proxy',
                'proxy_namespace'    => 'DoctrineMongoODMModule\Proxy',

                'generate_hydrators' => true,
                'hydrator_dir'       => 'data/DoctrineMongoODMModule/Hydrator',
                'hydrator_namespace' => 'DoctrineMongoODMModule\Hydrator',

                'default_db'         => 'cc_CfkFuuHDpsMc',

                'filters'            => array(),  // array('filterName' => 'BSON\Filter\Class'),

                'logger'             => null // 'DoctrineMongoODMModule\Logging\DebugStack'
            )
        ),

        'driver' => array(
            'odm_default' => array(
//                'drivers' => array()
            )
        ),

        'documentmanager' => array(
            'odm_default' => array(
//                'connection'    => 'odm_default',
//                'configuration' => 'odm_default',
//                'eventmanager' => 'odm_default'
            )
        ),

        'eventmanager' => array(
            'odm_default' => array(
                'subscribers' => array()
            )
        ),
    ),
);