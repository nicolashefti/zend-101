<?php
namespace Dictionary\Translator\Loader;

use Doctrine\ODM\EntityManager;
use Zend\I18n\Translator\Loader\RemoteLoaderInterface;

class DoctrineLoader implements RemoteLoaderInterface
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdocs}
     */
    public function load($locale, $textDomain)
    {
        // Use $this->em to query the database
    }
}