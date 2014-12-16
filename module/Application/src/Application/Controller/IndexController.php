<?php

namespace Application\Controller;

use Destination\Document\Destination;
use Zend\Http\Header\SetCookie;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $featured_posts = Destination::getDestinations();

        $featured_cities = Destination::available();

        $cookie   = new SetCookie('key', 'value', time() + 365 * 60 * 60 * 24);
        $response = $this->getResponse()->getHeaders();
        $response->addHeader($cookie);

        $this->flashMessenger()->addInfoMessage('Bonjour');

        return new ViewModel([
            'featured_posts'  => $featured_posts,
            'featured_cities' => $featured_cities,
            'flashMessages' => $this->flashMessenger()->getMessages()
        ]);
    }

    public function aboutAction()
    {
        return new ViewModel();
    }
}