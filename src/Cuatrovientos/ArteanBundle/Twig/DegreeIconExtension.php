<?php

namespace Cuatrovientos\ArteanBundle\Twig;

class DegreeIconExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('degree', array($this, 'degreeFilter')),
        );
    }

    public function degreeFilter($degreeCode)
    {
        $degrees = array(
           "19" => "🚚 TL",
            "16" => "🌍 CI",
            "15" => "🖥 ASIR",
           "17" => "💻 DAM",
            "13" => "💰 AF",
            "18" => "📢 GVEC",
            "10" => "💲 GA",
            "9" => "🛒 ACOM",
            "143" => "🚸 FPB",
            "144" => "⌨️SMR"
            );
            if (array_key_exists($degreeCode, $degrees)) {
                return $degrees[$degreeCode];
            } else {
                return $degreeCode;
             }
    }
}