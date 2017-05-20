<?php

namespace Cuatrovientos\ArteanBundle\Twig;

class ExtractExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('extract', array($this, 'extractFilter')),
        );
    }

    public function extractFilter($content)
    {
        return substr($content, 0, 100) .'...';
    }
}