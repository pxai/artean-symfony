<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Studies;
use Cuatrovientos\ArteanBundle\Service\DAO\StudiesDAO;


class StudiesBusiness extends GenericBusiness {

    public function findAllStudies($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllStudies($id, $start,$total);
    }


    public function countAllStudies()
    {
        return $this->entityDAO->countAllStudies();
    }

    public function searchStudies($studies, $start=0,$total=100)
    {
        return $this->entityDAO->searchStudies($studies, $start, $total);
    }

}
