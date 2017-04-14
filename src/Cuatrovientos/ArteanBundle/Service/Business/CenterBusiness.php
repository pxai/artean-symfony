<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Center;
use Cuatrovientos\ArteanBundle\Service\DAO\CenterDAO;


class CenterBusiness extends GenericBusiness {

    public function findAllCenters($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllCenters($id, $start,$total);
    }


    public function findCenters($term) {
        return $this->entityDAO->findCenters($term);
    }


    public function countAllCenters()
    {
        return $this->entityDAO->countAllCenters();
    }

    public function searchCenters($center, $start=0,$total=100)
    {
        return $this->entityDAO->searchCenters($center, $start, $total);
    }

}
