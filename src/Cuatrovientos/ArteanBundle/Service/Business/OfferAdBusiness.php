<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Offer;
use Cuatrovientos\ArteanBundle\Service\DAO\OfferDAO;


class OfferAdBusiness extends GenericBusiness {

    public function findAllOfferAds($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllOfferAds($id, $start,$total);
    }

    public function findAllPublishedOffersAd($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllPublishedOffersAd($id, $start,$total);
    }

    public function findAllOfferAdsByType($id=0)
    {
        return $this->entityDAO->findAllOfferAdsByType($id);
    }

    public function findAllOfferAdsByStatus($status=0)
    {
        return $this->entityDAO->findAllOfferAdsByStatus($status);
    }

    public function findOfferAds($term) {
        return $this->entityDAO->findOfferAds($term);
    }


    public function countAllOfferAds()
    {
        return $this->entityDAO->countAllOfferAds();
    }

    public function searchOfferAds($offer, $start=0,$total=100)
    {
        return $this->entityDAO->searchOfferAds($offer, $start, $total);
    }

}
