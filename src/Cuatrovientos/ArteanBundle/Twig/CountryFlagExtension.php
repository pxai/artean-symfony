<?php

namespace Cuatrovientos\ArteanBundle\Twig;

class CountryFlagExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('flag', array($this, 'flagFilter')),
        );
    }

    public function flagFilter($countryCode)
    {
        $flags = array(
           "ES" => "status-init",
            "EU" => "status-sent",
           "IN" => "status-sent",
            "EN" => "status-assessment",
            "FR" => "status-closed"
        );
        return $flags[$countryCode];
    }
}