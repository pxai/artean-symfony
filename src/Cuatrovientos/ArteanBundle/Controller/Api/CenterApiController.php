<?php

namespace  Cuatrovientos\ArteanBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\News;
use Cuatrovientos\ArteanBundle\Form\Type\NewsType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

class CenterApiController extends Controller
{
    /**
     * @Rest\View
     */
    public function indexAction(Request $request)
    {

        return $this->get("cuatrovientos_artean.bo.center")->findCenters($request->query->get('term'));
    }

}
