<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Page;
use Cuatrovientos\ArteanBundle\Service\DAO\PageDAO;


class PageBusiness extends GenericBusiness {

    public function findAllPages($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllPages($id, $start,$total);
    }


    public function findPages($term) {
        return $this->entityDAO->findPages($term);
    }


    public function countAllPages()
    {
        return $this->entityDAO->countAllPages();
    }

    public function searchPages($page, $start=0,$total=100)
    {
        return $this->entityDAO->searchPages($page, $start, $total);
    }

}
