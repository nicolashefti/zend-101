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

use Dictionary\Document\Dictionary;
use Application\Document\User;
use MyModule\Document\MyModule;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $loc = $this->getServiceLocator();

        $translator = $loc->get('translator');
        // $test = $loc->get('DictionaryLoader');
        // $test = $loc->get('DictionaryTranslator');
        $menu = $this->getServiceLocator()->get('MyModuleFacto');

        // Load from a file
        $translator->addTranslationFile("phparray",'./module/Application/language/aaa.php','homepage');

        // Load from the database
        // $translator->addTranslationFile("phparray",'./module/Application/language/aaa_bbb.php','homepage');
        // $translator->addTranslationFile('DictionaryTranslator','homepage','homepage');
        $translator->addTranslationFile('MyModuleFacto','text-domain','text-domain');

        $loc->get('ViewHelperManager')->get('translate')
            ->setTranslator($translator);

        return new ViewModel();
    }
    public function aboutAction()
    {
        return new ViewModel();
    }
}
