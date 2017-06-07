<?php

namespace Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name="")
    {
        $offers = $this->get("cuatrovientos_artean.bo.offer")->findAllPublishedOffers(0,0,10);
        $offerAds = $this->get("cuatrovientos_artean.bo.offerad")->findAllPublishedOffersAd(0,0,10);
        $news = $this->get("cuatrovientos_artean.bo.news")->findAllPublishedNews(0,0,10);
        $pages = $this->get("cuatrovientos_artean.bo.page")->findAllPages(0);
        return $this->render('CuatrovientosArteanBundle:Default:default.html.twig', array('offers'=>$offers,'offerAds'=>$offerAds,'news' => $news,'pages'=>$pages));
    }

    public function pageAction($permalink)
    {
        $offers = $this->get("cuatrovientos_artean.bo.offer")->findAllPublishedOffers(0,0,10);
        $offerAds = $this->get("cuatrovientos_artean.bo.offerad")->findAllPublishedOffersAd(0,0,10);
        $news = $this->get("cuatrovientos_artean.bo.news")->findAllPublishedNews(0,0,10);
        $pages = $this->get("cuatrovientos_artean.bo.page")->findAllPages(0);

        $current = $this->get("cuatrovientos_artean.bo.page")->findPageByPermalink($permalink);
        return $this->render('CuatrovientosArteanBundle:Default:page.html.twig', array('current'=>$current,'offers'=>$offers,'news' => $news,'pages'=>$pages));

    }

    public function newsAction($id,$permalink)
    {
        $offers = $this->get("cuatrovientos_artean.bo.offer")->findAllPublishedOffers(0,0,10);
        $offerAds = $this->get("cuatrovientos_artean.bo.offerad")->findAllPublishedOffersAd(0,0,10);
        $news = $this->get("cuatrovientos_artean.bo.news")->findAllPublishedNews(0,0,10);
        $pages = $this->get("cuatrovientos_artean.bo.page")->findAllPages(0);

        $current = $this->get("cuatrovientos_artean.bo.news")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Default:news.html.twig', array('current'=>$current,'offers'=>$offers,'news' => $news,'pages'=>$pages));

    }

    public function offerAction($id)
    {
        $offers = $this->get("cuatrovientos_artean.bo.offer")->findAllPublishedOffers(0,0,10);
        $offerAds = $this->get("cuatrovientos_artean.bo.offerad")->findAllPublishedOffersAd(0,0,10);
        $news = $this->get("cuatrovientos_artean.bo.news")->findAllPublishedNews(0,0,10);
        $pages = $this->get("cuatrovientos_artean.bo.page")->findAllPages(0);

        $offer = $this->get("cuatrovientos_artean.bo.offer")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Default:offer.html.twig', array('last_username'=>'','offer'=>$offer,'offers'=>$offers,'news' => $news,'pages'=>$pages));

    }

}
