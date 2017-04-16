<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Entity;
use Cuatrovientos\ArteanBundle\Entity\Fct;
use Cuatrovientos\ArteanBundle\Entity\Company;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\FctDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\CompanyDAO;

class FctBusiness extends GenericBusiness {

    private $companyDAO;
    private $applicantDAO;

    public function __construct (FctDAO $fctDAO,
                                 CompanyDAO $companyDAO,
                                 ApplicantDAO $applicantDAO) {
        $this->entityDAO = $fctDAO;
        $this->companyDAO = $companyDAO;
        $this->applicantDAO = $applicantDAO;
    }

    public function findAllFcts($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllFcts($id, $start,$total);
    }

    public function create(Entity $fct) {
        $this->setJobCompany($fct);
        $this->entityDAO->create($fct);
    }

    public function update(Entity $fct) {
        $this->setJobCompany($fct);
        $this->entityDAO->update($fct);
    }


    public function findFcts($term) {
        return $this->entityDAO->findFcts($term);
    }

    public function countAllFcts()
    {
        return $this->entityDAO->countAllFcts();
    }

    public function searchFcts($fct, $start=0,$total=100)
    {
        return $this->entityDAO->searchFcts($fct, $start, $total);
    }

    private function setJobCompany($fct)
    {
        if (preg_match("/^[0-9]+$/", $fct->getCompanyName())) {
            // Check that exists
            if ($company = $this->companyDAO->selectById($fct->getCompanyName())) {
                $fct->setCompany($company);
            } else { // else, insert that number as the name
                $fct->setNewCompany();
            }
        } else { // Else, new Company must be created
            $company = new Company();
            $company->setEmpresa($fct->getCompanyName());
            $this->companyDAO->create($company);
            $fct->setCompany($company);
        }
    }
}
