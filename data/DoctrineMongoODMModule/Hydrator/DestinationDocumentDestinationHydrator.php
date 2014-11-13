<?php

namespace DoctrineMongoODMModule\Hydrator;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Hydrator\HydratorInterface;
use Doctrine\ODM\MongoDB\UnitOfWork;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ODM. DO NOT EDIT THIS FILE.
 */
class DestinationDocumentDestinationHydrator implements HydratorInterface
{
    private $dm;
    private $unitOfWork;
    private $class;

    public function __construct(DocumentManager $dm, UnitOfWork $uow, ClassMetadata $class)
    {
        $this->dm = $dm;
        $this->unitOfWork = $uow;
        $this->class = $class;
    }

    public function hydrate($document, $data, array $hints = array())
    {
        $hydratedData = array();

        /** @Field(type="id") */
        if (isset($data['_id'])) {
            $value = $data['_id'];
            $return = $value instanceof \MongoId ? (string) $value : $value;
            $this->class->reflFields['id']->setValue($document, $return);
            $hydratedData['id'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['title'])) {
            $value = $data['title'];
            $return = (string) $value;
            $this->class->reflFields['title']->setValue($document, $return);
            $hydratedData['title'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['description'])) {
            $value = $data['description'];
            $return = (string) $value;
            $this->class->reflFields['description']->setValue($document, $return);
            $hydratedData['description'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['address'])) {
            $value = $data['address'];
            $return = (string) $value;
            $this->class->reflFields['address']->setValue($document, $return);
            $hydratedData['address'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['city'])) {
            $value = $data['city'];
            $return = (string) $value;
            $this->class->reflFields['city']->setValue($document, $return);
            $hydratedData['city'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['amenities'])) {
            $value = $data['amenities'];
            $return = (string) $value;
            $this->class->reflFields['amenities']->setValue($document, $return);
            $hydratedData['amenities'] = $return;
        }

        /** @Field(type="float") */
        if (isset($data['price'])) {
            $value = $data['price'];
            $return = (float) $value;
            $this->class->reflFields['price']->setValue($document, $return);
            $hydratedData['price'] = $return;
        }

        /** @Field(type="collection") */
        if (isset($data['picture'])) {
            $value = $data['picture'];
            $return = $value;
            $this->class->reflFields['picture']->setValue($document, $return);
            $hydratedData['picture'] = $return;
        }
        return $hydratedData;
    }
}