<?php

namespace Application\Twig\Filter;

use Twig_Extension;
use Twig_SimpleFilter;

class TruncateText extends Twig_Extension {

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('truncateText', array($this, 'truncateFilter')),
        );
    }

    public static function truncateFilter($string)
    {
        $new_string = substr($string, 0, strrpos(substr($string, 0, 200), '.') + 1);

        return $new_string;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'truncateText';
    }
}