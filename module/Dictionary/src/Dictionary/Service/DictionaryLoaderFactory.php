<?php
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DictionaryLoaderFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new DictionaryLoader(
            // $serviceLocator->get('Zend\Db\Adapter\Adapter')
        );
    }
}