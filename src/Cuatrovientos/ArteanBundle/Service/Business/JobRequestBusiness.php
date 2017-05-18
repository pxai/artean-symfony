<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Entity;
use Cuatrovientos\ArteanBundle\Entity\JobRequest;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Entity\Company;
use Cuatrovientos\ArteanBundle\Entity\JobRequestSelected;
use Cuatrovientos\ArteanBundle\Entity\JobRequestStatus;
use Cuatrovientos\ArteanBundle\Service\DAO\JobRequestDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\CompanyDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\JobRequestSelectedDAO;

class JobRequestBusiness extends GenericBusiness {

    private $companyDAO;
    private $jobRequestSelectedDAO;
    private $applicantDAO;

    public function __construct (JobRequestDAO $jobRequestDAO,
                                 CompanyDAO $companyDAO,
                                 JobRequestSelectedDAO $jobRequestSelectedDAO,
                                    ApplicantDAO $applicantDAO) {
        $this->entityDAO = $jobRequestDAO;
        $this->companyDAO = $companyDAO;
        $this->jobRequestSelectedDAO = $jobRequestSelectedDAO;
        $this->applicantDAO = $applicantDAO;
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

    public function updateApplicantSelection(Entity $jobRequest) {
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

    public function deleteSelected ($jobrequestid, $applicantid) {
        return $this->entityDAO->deleteSelected($jobrequestid, $applicantid);
    }

    public function deleteAllPreselected ($jobrequestid) {
        $this->changeStatus($jobrequestid, JobRequestStatus::INIT);
        return $this->entityDAO->deleteAllPreselected($jobrequestid);
    }

    public function deleteAllSelected ($jobrequestid) {
        $this->changeStatus($jobrequestid, JobRequestStatus::PRESELECTED);
        return $this->entityDAO->deleteAllSelected($jobrequestid);
    }

    public function addSelected ($jobrequestid, $applicantid) {
        $jobRequest = $this->entityDAO->selectById($jobrequestid);
        $applicant = $this->applicantDAO->selectById($applicantid);
        $applicant->setId($applicantid);
        $jobRequest->addSelected($applicant);

        $jobRequest->setStatus(JobRequestStatus::SELECTED);
        $this->entityDAO->update($jobRequest);

        return  $this->entityDAO->deletePreselected($jobrequestid, $applicantid);
    }

    public function addAllSelected ($jobrequestid) {
        $jobRequest = $this->entityDAO->selectById($jobrequestid);
        $jobRequest->setSelectedApplicants($jobRequest->getPreselectedApplicants());
        $jobRequest->setPreselectedApplicants(null);

        $jobRequest->setStatus(JobRequestStatus::SELECTED);
        return $this->entityDAO->update($jobRequest);
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

    public function  changeStatus ($jobrequestid, $status) {
        $jobRequest = $this->entityDAO->selectById($jobrequestid);
        $jobRequest->setStatus($status);
        $this->entityDAO->update($jobRequest);
    }


}
