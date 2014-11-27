<?php

namespace Application\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

class RenderString extends Twig_Extension
{

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction(
                'myTwigExtension',
                [$this, 'myTwigExtension']
            ),
        ];
    }

    public static function myTwigExtension()
    {
        return "Hello Twig!";
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'renderString';
    }

}