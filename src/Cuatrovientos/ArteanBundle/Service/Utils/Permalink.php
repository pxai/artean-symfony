<?php

namespace  Cuatrovientos\ArteanBundle\Service\Utils;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Permalink {
    public function permalink ($title) {
        $url = '';
        $patterns = array("/\s+/");
        $subst = array("-");
        $url = preg_replace($patterns, $subst, $title);
        return strtolower($url);
    }
}