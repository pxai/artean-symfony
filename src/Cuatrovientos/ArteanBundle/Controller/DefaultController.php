<?php

namespace Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name="")
    {
        $offers = $this->get("cuatrovientos_artean.bo.offer")->findAllOffers(0,0,10);
        $news = $this->get("cuatrovientos_artean.bo.news")->findAllNews(0,0,10);
        $pages = $this->get("cuatrovientos_artean.bo.page")->findAllPages(0);
        return $this->render('CuatrovientosArteanBundle:Default:default.html.twig', array('offers'=>$offers,'news' => $news,'pages'=>$pages));
    }

    public function pageAction($page)
    {
        $news = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:News")->findPublicNews();
        $pages = $this->get("cuatrovientos_artean.bo.page")->findAllPagesByType(0);
        return $this->render('CuatrovientosArteanBundle:Default:default.html.twig', array('news' => $news));
    }
}
