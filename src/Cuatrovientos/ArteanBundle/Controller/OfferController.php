<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Offer;
use Cuatrovientos\ArteanBundle\Form\Type\OfferType;

class OfferController extends Controller
{
    /**
    *
    *
    */
    public function indexAction()
    {
        //$centers = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Center")->findAll();
        $offers = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Offer")->findOffer();
        return $this->render('CuatrovientosArteanBundle:Offer:index.html.twig', array('offers'=>$offers));
    }  
}
