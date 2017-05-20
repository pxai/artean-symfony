<?php

namespace Cuatrovientos\ArteanBundle\Twig;

class JobRequestStatusColorExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('statusColor', array($this, 'statusColorFilter')),
        );
    }

    public function statusColorFilter($status)
    {
        $cssClass = array(
           "Recepción solicitud" => "status-init",
           "Envío candidato" => "status-sent",
            "Valoración" => "status-assessment",
            "Cierre" => "status-closed"
        );
        return $cssClass[$status];
    }
}