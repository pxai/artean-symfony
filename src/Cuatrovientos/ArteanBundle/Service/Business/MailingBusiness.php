<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Entity;
use Cuatrovientos\ArteanBundle\Entity\Mailing;
use Cuatrovientos\ArteanBundle\Entity\Company;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\MailingDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\CompanyDAO;

class MailingBusiness extends GenericBusiness {

    private $companyDAO;
    private $applicantDAO;

    public function __construct (MailingDAO $mailingDAO,
                                 CompanyDAO $companyDAO,
                                 ApplicantDAO $applicantDAO) {
        $this->entityDAO = $mailingDAO;
        $this->companyDAO = $companyDAO;
        $this->applicantDAO = $applicantDAO;
    }

    public function findAllMailings($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllMailings($id, $start,$total);
    }
    
    public function findMailings($term) {
        return $this->entityDAO->findMailings($term);
    }

    public function countAllMailings()
    {
        return $this->entityDAO->countAllMailings();
    }

    public function searchMailings($mailing, $start=0,$total=100)
    {
        return $this->entityDAO->searchMailings($mailing, $start, $total);
    }

    public function updateApplicantSelection(Entity $mailing) {
        $this->entityDAO->update($mailing);
    }

    public function updateCompanySelection(Entity $mailing) {
        $this->entityDAO->update($mailing);
    }

    public function deleteSelectedApplicant($mailingid, $applicantid)
    {
        return  $this->entityDAO-> deleteSelectedApplicant($mailingid, $applicantid);
    }


    public function deleteAllSelectedApplicants($mailingid)
    {
        return  $this->entityDAO->deleteAllSelectedApplicants($mailingid);
    }

    public function deleteSelectedCompany($mailingid, $companyid)
    {
        return  $this->entityDAO-> deleteSelectedCompany($mailingid, $companyid);
    }

    public function deleteAllSelectedCompanies($mailingid)
    {
        return  $this->entityDAO->deleteAllSelectedCompanies($mailingid);
    }

    public function deleteAttachment($mailingid, $attachmentid)
    {
        return  $this->entityDAO->deleteAttachment($mailingid, $attachmentid);
    }

    public function deleteAllAttachments($mailingid)
    {
        return  $this->entityDAO->deleteAllAttachments($mailingid);
    }
}
