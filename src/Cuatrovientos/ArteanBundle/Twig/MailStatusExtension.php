<?php

namespace Cuatrovientos\ArteanBundle\Twig;

class MailStatusExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('mailStatus', array($this, 'mailStatusFilter')),
        );
    }

    public function mailStatusFilter($status)
    {
        $cssClass = array(
           "0" => "fa fa-envelope-o status-none",
           "1" => "fa fa-envelope-o status-warning",
            "2" => "fa fa-envelope status-success",
            "3" => "fa fa-envelope status-error"
        );
        return $cssClass[$status];
    }
}