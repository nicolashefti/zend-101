<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\I18n\Translator\Translator;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {

        $loc = $this->getServiceLocator();

        $translator = $loc->get('translator');

        // Load from a file
        $translator->addTranslationFile("phparray",'./module/Application/language/aaa.php','homepage');

        // Load from the database
        $translator->addTranslationFile("phparray",'./module/Application/language/aaa_bbb.php','homepage');
        // $translator->addTranslationFile('DictionaryLoader','homepage','homepage');

        $loc->get('ViewHelperManager')->get('translate')
            ->setTranslator($translator);

        return new ViewModel();
    }
    public function aboutAction()
    {
        return new ViewModel();
    }
}
