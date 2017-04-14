<?php

namespace  Cuatrovientos\ArteanBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

class StudiesApiController extends Controller
{
    /**
     * @Rest\View
     */
    public function indexAction($term)
    {
        return $this->get("cuatrovientos_artean.bo.studies")->findStudies($term);
    }

}
