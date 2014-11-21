<?php
namespace Dictionary\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Dictionary\Translator\Loader\DoctrineLoader;

class DictionaryTranslatorFactory implements FactoryInterface
{
    /**
     * {@inheritdocs}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /**
         * $serviceLocator is the translator plugin manager, to get into the
         * root service locator we need the getServiceLocator() call
         *
         * @see http://juriansluiman.nl/en/article/120
         */
        $sm = $serviceLocator->getServiceLocator();
        $em = $sm->get('Doctrine.DocumentManager.odm_default');

        return new DoctrineLoader($em);
    }
}