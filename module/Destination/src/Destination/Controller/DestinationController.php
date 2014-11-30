<?php

namespace Destination\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

use Destination\Document\Destination;
use Destination\Form\DestinationForm;

use Zend\Debug\Debug;

class DestinationController extends AbstractActionController
{
    protected $em;
    
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        }
        return $this->em;
    }
    
    public function indexAction()
    {
        $qb_destination = $this->getEntityManager()
                               ->createQueryBuilder('Destination\Document\Destination');                         
                                   
        if ( $city_search = $this->params()->fromQuery('city')) {
            $qb_destination->field('city')->equals($city_search); 
        }

        $published_search = ($this->params()->fromQuery('published','1') == '1');
        // Debug::dump($published_search);

        $qb_destination->field('published')->equals($published_search);
        
        $destinations = $qb_destination->getQuery()->execute();

        return new ViewModel(array(
                                'destinations' => $destinations,
                                'title_search' => $city_search,
                            ));
        
    }
    
    public function showAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('destination');
        }       
        return new ViewModel(array('destination' => $this->getEntityManager()->getRepository('Destination\Document\Destination')->find($id)));
    }

    public function addAction()
    {
        $form = new DestinationForm();
        
        $form->get('submit')->setValue('Add');
        $form->setAttribute('action', '/destination/add');
 
        $request = $this->getRequest();
        if ($request->isPost()) {
            $destination = new Destination();

            $form->setInputFilter($destination->getInputFilter());
            
            $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            
            $form->setData($post);
            // die(var_dump($post));
            
            if ($form->isValid()) {
                $data = $form->getData();
                $data['published'] = False;
                $destination->exchangeArray($data);
                $this->getEntityManager()->persist($destination);
                $this->getEntityManager()->flush();
 
                // Redirect to list of albums
                return $this->redirect()->toRoute('destination');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id',0);
        if (!$id) {
            return $this->redirect()->toRoute('destination');
        }

        $destination = $this->getEntityManager()->getRepository('Destination\Document\Destination')->find($id);
        
        if (!$destination) {
            return $this->redirect()->toRoute('destination', array(
                'action' => 'index'
            ));
        }
        
        $form  = new DestinationForm();
    
        $form->bind($destination);
        $form->get('submit')->setAttribute('value', 'Edit');
        $form->setAttribute('action', '/destination/edit/' . $id);
        
               
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setInputFilter($destination->getInputFilter());
            
            $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            // die(var_dump($post));
            $form->setData($post);

            if ($form->isValid()) {

                $this->getEntityManager()->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('destination');
            }
        }
        

        return array(
            'id' => $id,
            'form' => $form,
        );      
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id',0);
        if (!$id) {
            return $this->redirect()->toRoute('destination');
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
 
            if ($del == 'Yes') {
                $id = $request->getPost('id');
                
                $destination = $this->getEntityManager()->find('Destination\Document\Destination', $id);
                if ($destination) {
                
                    $this->getEntityManager()->remove($destination);
                    $this->getEntityManager()->flush();
                }
            }
 
            // Redirect to list of albums
            return $this->redirect()->toRoute('destination');
        }
        
        return array(
            'id'    => $id,
            'destination' => $this->getEntityManager()->find('Destination\Document\Destination', $id)
        );
        
    }
    
    public function citiesAction()
    {    
        $term = preg_quote( $this->params()->fromQuery('term') , '~'); 

        $available_cities = preg_grep('/^' . $term . '/i', Destination::available());

        return new JsonModel($available_cities);
    }
}
