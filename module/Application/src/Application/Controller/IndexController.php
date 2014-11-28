<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Destination\Document\Destination;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $featured_posts = [
            [
                'title' => 'Hello'
            ],
            [
                'title' => 'Word'
            ],
            [
                'title' => 'Hold on!'
            ],
        ];
        $featured_cities = Destination::available();
        return new ViewModel([
            'featured_posts' => $featured_posts,
            'featured_cities' => $featured_cities
        ]);
    }
    public function aboutAction()
    {
        return new ViewModel();
    }
}
