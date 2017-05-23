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
           "AL" => "🇩🇪", "CAT" => "CAT",
            "CA" => "CAT",
           "EU" => "EU",
            "FR" => "🇫🇷",
            "IN" => "🇬🇧",
            "IT" => "🇮🇹",
            "PT" => "🇵🇹",
            "ES" => "🇪🇸",
            "RU" => "🇷🇺",
            "RO" => "🇷🇴",
            "UK" => "🇺🇦",
            "GAL" => "GAL",
            "JP" => "🇯🇵",
            "CH" => "🇨🇳",
            "BG" => "🇧🇬",
            "MA" => "🇲🇦",
            "PO"=> "🇵🇱"
            );
            if (array_key_exists($countryCode, $flags)) {
                return $flags[$countryCode];
            } else {
                return $countryCode;
             }
    }
}