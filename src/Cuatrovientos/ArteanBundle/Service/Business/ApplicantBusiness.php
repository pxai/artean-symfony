<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantStudiesDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantLanguagesDAO;

class ApplicantBusiness extends GenericBusiness {

    private $applicantStudiesDAO;
    private $applicantLanguagesDAO;

    public function __construct (ApplicantDAO $applicantDAO,
                                 ApplicantStudiesDAO $applicantStudiesDAO,
                                 ApplicantLanguagesDAO $applicantLanguagesDAO) {
        $this->entityDAO = $applicantDAO;
        $this->applicantStudiesDAO = $applicantStudiesDAO;
        $this->applicantLanguagesDAO = $applicantLanguagesDAO;

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
        $this->applicantStudiesDAO->update($applicantStudies);
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
}
