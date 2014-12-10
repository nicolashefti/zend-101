<?php

namespace Destination\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\FileInput;


/** @ODM\Document(collection="destination") */
class Destination 
{
    /** @ODM\Id */
    public $id;

    /** @ODM\Field(type="boolean") */
    public $published;

    /**
     * Date of last update
     * @ODM\Date
     */
    public $updatedAt;

    /** @ODM\Field(type="string") */
    public $title;
    
    /** @ODM\Field(type="string") */
    public $description;

    /** @ODM\Field(type="string") */
    public $address;

    /** @ODM\Field(type="string") */
    public $phone;

    /** @ODM\Field(type="string") */
    public $email;

    /** @ODM\String */
    public $city;

    /** @ODM\Collection */
    public $amenities;
    
    /** @ODM\Float */
    public $price;
    
    /** @ODM\Collection */
    public $picture;

    public $inputFilter;

    /**
     * @return the $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return the $title
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param field_type $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @param field_type $title
     */
    public function setTitle($name) {
        $this->title = $name;
    }
    
    public function available() {
    
        return ['Berlin','Hamburg','Munich','Köln','Frankfurt','Stuttgart','Düsseldorf','Dortmund','Essen','Bremen',
               'Dresden','Leipzig','Hannover','Nuremberg','Duisburg','Bochum','Wuppertail','Bonn','Bielefeld','Mannheim'];
    }

    public function getDestinations($num_destination = 3) {

        $em = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        $query = $em->createQueryBuilder('Destination\Document\Destination');

        $query
            ->field('published')->equals(true)
            ->limit($num_destination)
            ->sort('updatedAt', 'desc');

        $destinations = $query->getQuery()->execute();

        return $destinations;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'amenities[wifi]',
                'required' => false,
            ));

            $inputFilter->add(array(
                'name'     => 'title',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 2,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));

             $inputFilter->add(array(
                'name'     => 'city',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 2,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'description',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 10,
                            'max'      => 1200,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name'     => 'price',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            // File Input
            $file = new FileInput('image-file');
            $file->setRequired(false);
            $file->getFilterChain()->attachByName(
                'filerenameupload',
                array(
                    'target'          => './public/img/uploads/',
                    'overwrite'       => true,
                    'use_upload_name' => true,
                )
            );
            $inputFilter->add($file);

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

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
        $this->published = $data['published'];
        $this->updatedAt = new \MongoDate();

        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->price = $data['price'];

        foreach ($data['amenities'] as $key => $amenity) {
            $this->amenities[$key] = $amenity;
        }

        $this->address = $data['address'];
        $this->city = $data['city'];
        $this->phone = $data['phone'];
        $this->email = $data['email'];

        if ($data['image-file']['error'] == 0)
            $this->picture[] = $data['image-file'];
    }

       
}
