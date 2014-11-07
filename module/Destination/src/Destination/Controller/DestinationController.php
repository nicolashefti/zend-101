<?php

namespace Destination\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Destination\Document\Destination;
use Destination\Form\DestinationForm;

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
                                   
        $title_search = $this->params()->fromQuery('title');
        if ($title_search) {
            $qb_destination->field('title')->equals($title_search); 
        }
        
        $query = $qb_destination->getQuery();
             
        return new ViewModel(array(
                                'destinations' => $query,
                                'title_search' => $title_search,
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
 
        $request = $this->getRequest();
        if ($request->isPost()) {
            $destination = new Destination();
            $form->setData($request->getPost());
 
            if ($form->isValid()) {
                $destination->exchangeArray($form->getData());
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
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            $form->setData($request->getPost());

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
}
