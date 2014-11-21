<?php
namespace Dictionary;

use Zend\ServiceManager\Config;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * @return array
     */
    public function getServiceConfig() {
        return array(
            'invokables' => array(
                'DictionaryLoader' => 'Dictionary\Document\Dictionary'
            ),
            'factories' => array(
                'DictionaryTranslator' => 'Dictionary\Service\DictionaryTranslatorFactory'
            )
        );
    }

    /**
     * Gets module configuration
     *
     * @return array
     */
    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }
}