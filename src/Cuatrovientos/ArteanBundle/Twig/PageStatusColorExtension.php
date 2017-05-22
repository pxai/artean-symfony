<?php

namespace Cuatrovientos\ArteanBundle\Twig;

class PageStatusColorExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('pageStatusColor', array($this, 'pageStatusColorFilter')),
        );
    }

    public function pageStatusColorFilter($status)
    {
        $cssClass = array(
           "0" => "page-draft",
           "1" => "page-notpublished",
            "2" => "page-published",
            "3" => "page-private",
            "5" => "page-offer",
            "6" => "page-published"
        );
        return $cssClass[$status];
    }
}