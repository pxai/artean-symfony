<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Company;
use Cuatrovientos\ArteanBundle\Service\DAO\CompanyDAO;


class CompanyBusiness extends GenericBusiness {

    public function findAllCompanies($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllCompanies($id, $start,$total);
    }


    public function countAllCompanies()
    {
        return $this->entityDAO->countAllCompanies();
    }

    public function searchCompanies($company, $start=0,$total=100)
    {
        return $this->entityDAO->searchCompanies($company, $start, $total);
    }

}
