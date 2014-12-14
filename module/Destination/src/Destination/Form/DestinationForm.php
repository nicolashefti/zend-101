<?php

namespace Destination\Form;

use Zend\Form\Form;
use Zend\Form\Element;

use Destination\Document\Destination;

class DestinationForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('destination');

        $this->setAttributes(array(
            'class' => 'form'
        ));
        
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
            'options' => array(
                'label' => ' ',
            ),
        ));

        $this->add(array(
            'name' => 'published',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'Published',

            ),
        ));

        $this->add(array(
            'name' => 'title',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title',
            ),
            'attributes' => [
              'class' => 'form-control',

            ]
        ));

        $this->add(array(
            'name' => 'address',
            'type' => 'Text',
            'options' => array(
                'label' => 'Address',
            ),
            'attributes' => [
                'class' => 'form-control'
            ]
        ));

         $this->add(array(
           'type' => 'Select',
           'name' => 'city',
           'options' => array(
             'label' => 'City',
             'value_options' => array_combine( Destination::available(), Destination::available() ),
           ),
           'attributes' => [
              'class' => 'form-control'
           ]
         ));

        $this->add(array(
            'name' => 'phone',
            'type' => 'Text',
            'options' => array(
                'label' => 'Phone',
            ),
            'attributes' => [
                'class' => 'form-control',
            ]
        ));

        $this->add(array(
            'name' => 'price',
            'type' => 'Number',
            'options' => array(
                'label' => 'Price',
                'class' => 'form-control'
         ),
           'attributes' => [
              'class' => 'form-control'
           ]
        ));

        $multiCheckbox = new Element\MultiCheckbox('amenities');
        $multiCheckbox->setLabel('Amenities');
        $multiCheckbox->setValueOptions(array(
            'wifi' => 'WIFI',
            'parking' => 'Parking',
            'disabled' => 'Disabled access'
        ));
        $this->add($multiCheckbox);

        $form = new Form('my-form');
        $form->add($multiCheckbox);

        $this->add(array(
            'name' => 'description',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Description',
            ),
           'attributes' => [
              'class' => 'form-control'
           ]
        ));
        
        $file = new Element\File('image-file');
        $file->setLabel('Pictures')
             ->setAttribute('id', 'image-file');
        $this->add($file);
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'options' => array(
                'label' => ' ',
            ),
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
              'class' => 'btn btn-primary'
           ),
        ));
    }    
}
