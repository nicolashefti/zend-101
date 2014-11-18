<?php

namespace Dictionary\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\FileInput;

/** @DOM\Document(collection="dictionary") */
class Dictionary
{
    /** @DOM\Id */
    public $id;

    /** @DOM\Field(type="string") */
    public $name;

    /** @DOM\Collection */
    public $entries;


    /**
     * Default Zend Hydrator exepects getArrayCopy() and exchangeArray() to be implemented
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    public function exchangeArray($data = array())
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->entries = $data['entries'];
    }
}