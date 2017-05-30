<?php

namespace Cuatrovientos\ArteanBundle\Twig;

class MailingStatusExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('mailingStatus', array($this, 'mailingStatusFilter')),
        );
    }

    public function mailingStatusFilter($status)
    {
        $cssClass = array(
           "0" => "Creado, sin enviar",
           "1" => "En proceso de envío",
            "2" => "En pausa",
            "3" => "Envío finalizado"
        );
        return $cssClass[$status];
    }
}