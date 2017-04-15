<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Entity\Center;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantStudiesDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantLanguagesDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantJobsDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\CenterDAO;

class ApplicantBusiness extends GenericBusiness {

    private $applicantStudiesDAO;
    private $applicantLanguagesDAO;
    private $applicantJobsDAO;
    private $centerDAO;

    public function __construct (ApplicantDAO $applicantDAO,
                                 ApplicantStudiesDAO $applicantStudiesDAO,
                                 ApplicantLanguagesDAO $applicantLanguagesDAO,
                                 ApplicantJobsDAO $applicantJobsDAO,
                                 CenterDAO $centerDAO) {
        $this->entityDAO = $applicantDAO;
        $this->applicantStudiesDAO = $applicantStudiesDAO;
        $this->applicantLanguagesDAO = $applicantLanguagesDAO;
        $this->applicantJobsDAO = $applicantJobsDAO;
        $this->centerDAO = $centerDAO;
    }


    public function findAllApplicantData($userid)
    {
        return $this->entityDAO->findAllApplicantData($userid);
    }

    public function selectApplicantStudies($id, $applicant) {
        return $this->applicantStudiesDAO->selectByIdAndApplicant($id, $applicant);
    }

    public function saveApplicantStudies($applicantStudies) {
        $this->applicantStudiesDAO->create($applicantStudies);
    }

    public function updateApplicantStudies($applicantStudies) {
        // If id is inserted
        if (preg_match("/^[0-9]+$/",$applicantStudies->getCenterValue())) {
            $this->applicantStudiesDAO->update($applicantStudies->setNewCenter());
        } else { // Else, new Center must be created
            $center = new Center();
            $center->setName($applicantStudies->getCenterValue());
            $this->centerDAO->create($center);
            $applicantStudies->setCenter($center);
            $this->applicantStudiesDAO->update($applicantStudies);
        }
    }

    public function deleteApplicantStudies($applicantStudies) {
        $this->applicantStudiesDAO->remove($applicantStudies);
    }

    public function selectApplicantLanguages($id, $applicant) {
        return $this->applicantLanguagesDAO->selectByIdAndApplicant($id, $applicant);
    }

    public function saveApplicantLanguages($applicantLanguages) {
        $this->applicantLanguagesDAO->create($applicantLanguages);
    }

    public function updateApplicantLanguages($applicantLanguages) {
        $this->applicantLanguagesDAO->update($applicantLanguages);
    }

    public function deleteApplicantLanguages($applicantLanguages) {
        $this->applicantLanguagesDAO->remove($applicantLanguages);
    }

    public function selectApplicantJobs($id, $applicant) {
        return $this->applicantJobsDAO->selectByIdAndApplicant($id, $applicant);
    }

    public function saveApplicantJobs($applicantJobs) {
        $this->applicantJobsDAO->create($applicantJobs);
    }

    public function updateApplicantJobs($applicantJobs) {
        $this->applicantJobsDAO->update($applicantJobs);
    }

    public function deleteApplicantJobs($applicantJobs) {
        $this->applicantJobsDAO->remove($applicantJobs);
    }
}
