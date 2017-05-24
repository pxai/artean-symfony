<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Offer;
use Cuatrovientos\ArteanBundle\Service\DAO\OfferDAO;


class OfferBusiness extends GenericBusiness {

    public function findAllOffers($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllOffers($id, $start,$total);
    }

    public function findAllPublishedOffers($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllPublishedOffers($id, $start,$total);
    }

    public function findAllOffersByType($id=0)
    {
        return $this->entityDAO->findAllOffersByType($id);
    }

    public function findAllOffersByStatus($status=0)
    {
        return $this->entityDAO->findAllOffersByStatus($status);
    }

    public function findOffers($term) {
        return $this->entityDAO->findOffers($term);
    }


    public function countAllOffers()
    {
        return $this->entityDAO->countAllOffers();
    }

    public function searchOffers($offer, $start=0,$total=100)
    {
        return $this->entityDAO->searchOffers($offer, $start, $total);
    }

}
