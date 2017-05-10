<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Entity;
use Cuatrovientos\ArteanBundle\Entity\JobRequest;
use Cuatrovientos\ArteanBundle\Entity\Company;
use Cuatrovientos\ArteanBundle\Service\DAO\JobRequestDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\CompanyDAO;

class JobRequestBusiness extends GenericBusiness {

    private $companyDAO;

    public function __construct (JobRequestDAO $jobRequestDAO,
                                 CompanyDAO $companyDAO) {
        $this->entityDAO = $jobRequestDAO;
        $this->companyDAO = $companyDAO;
    }

    public function findAllJobRequests($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllJobRequests($id, $start,$total);
    }

    public function create(Entity $jobRequest) {
        $this->setJobCompany($jobRequest);
        $this->entityDAO->create($jobRequest);
    }

    public function update(Entity $jobRequest) {
        $this->setJobCompany($jobRequest);
        $this->entityDAO->update($jobRequest);
    }

    public function findJobRequests($term) {
        return $this->entityDAO->findJobRequests($term);
    }

    public function countAllJobRequests()
    {
        return $this->entityDAO->countAllJobRequests();
    }

    public function searchJobRequest($company, $start=0,$total=100)
    {
        return $this->entityDAO->searchJobRequest($company, $start, $total);
    }

    public function deletePreselected ($jobrequestid, $applicantid) {
        return $this->entityDAO->deletePreselected($jobrequestid, $applicantid);
    }

    private function setJobCompany($jobRequest)
    {
        if (preg_match("/^[0-9]+$/", $jobRequest->getCompanyName())) {
            // Check that exists
            if ($company = $this->companyDAO->selectById($jobRequest->getCompanyName())) {
                $jobRequest->setCompany($company);
            } else { // else, insert that number as the name
                $jobRequest->setNewCompany();
            }
        } else { // Else, new Company must be created
            $company = new Company();
            $company->setEmpresa($jobRequest->getCompanyName());
            $this->companyDAO->create($company);
            $jobRequest->setCompany($company);
        }
    }


}
