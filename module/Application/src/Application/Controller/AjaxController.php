<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class AjaxController extends AbstractActionController
{

    public function indexAction()
    {
        $result = new JsonModel(array(
            'time' => date('Y m d H:i:s')
        ));
        return $result;
    }


}

