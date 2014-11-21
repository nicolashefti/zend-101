<?php

namespace MyModule\Service;

use MyModule\MyModuleLoader;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;
use \Zend\I18n\Translator\Translator;

class MyModuleFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator->get('doctrine.documentmanager.odm_default');

        $loaderPlugin = new MyModuleLoader($serviceLocator);

        // Create translator instance
        $translator = Translator::factory(['event_manager_enabled' => true, 'locale' => 'de_DE']);
        $translator->getPluginManager()->setService('MyModuleFacto', $loaderPlugin);
        $translator->addRemoteTranslations('MyModuleFacto', '*');

        // var_dump($translator);
        // return $translator;
    }
}