<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Entity\Center;
use Cuatrovientos\ArteanBundle\Entity\Studies;
use Cuatrovientos\ArteanBundle\Entity\Company;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantStudiesDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantLanguagesDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantJobsDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\CenterDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\StudiesDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\CompanyDAO;

class ApplicantBusiness extends GenericBusiness {

    private $applicantStudiesDAO;
    private $applicantLanguagesDAO;
    private $applicantJobsDAO;
    private $centerDAO;
    private $studiesDAO;
    private $companyDAO;

    public function __construct (ApplicantDAO $applicantDAO,
                                 ApplicantStudiesDAO $applicantStudiesDAO,
                                 ApplicantLanguagesDAO $applicantLanguagesDAO,
                                 ApplicantJobsDAO $applicantJobsDAO,
                                 CenterDAO $centerDAO,
                                 StudiesDAO $studiesDAO,
                                 CompanyDAO $companyDAO) {
        $this->entityDAO = $applicantDAO;
        $this->applicantStudiesDAO = $applicantStudiesDAO;
        $this->applicantLanguagesDAO = $applicantLanguagesDAO;
        $this->applicantJobsDAO = $applicantJobsDAO;
        $this->centerDAO = $centerDAO;
        $this->studiesDAO = $studiesDAO;
        $this->companyDAO = $companyDAO;
    }

    public function findAllApplicants($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllApplicants($id, $start,$total);
    }

    public function detailedSearchApplicants($applicant)
    {
        return $this->entityDAO->detailedSearchApplicants($applicant);

    }

    public function countAllApplicants()
    {
        return $this->entityDAO->countAllApplicants();
    }

    public function searchApplicants($applicant, $start=0,$total=100)
    {
        return $this->entityDAO->searchApplicants($applicant, $start, $total);
    }

    public function findAllApplicantDataByUserId($userid)
    {
        return $this->entityDAO->findAllApplicantDataByUserId($userid);
    }

    public function findAllApplicantData($userid)
    {
        return $this->entityDAO->findAllApplicantData($userid);
    }


    public function findApplicants($term)
    {
        return $this->entityDAO->findApplicants($term);
    }

    public function selectApplicantStudies($id, $applicant) {
        return $this->applicantStudiesDAO->selectByIdAndApplicant($id, $applicant);
    }

    public function selectApplicantStudiesById($id) {
        return $this->applicantStudiesDAO->selectById($id);
    }

    public function saveApplicantStudies($applicantStudies) {
        $this->setStudiesCenter($applicantStudies);
        $this->setStudiesStudies($applicantStudies);

        $this->applicantStudiesDAO->create($applicantStudies);
    }

    public function updateApplicantStudies($applicantStudies) {
        $this->setStudiesCenter($applicantStudies);
        $this->setStudiesStudies($applicantStudies);

        $this->applicantStudiesDAO->update($applicantStudies);
    }

    public function deleteApplicantStudies($applicantStudies) {
        $this->applicantStudiesDAO->remove($applicantStudies);
    }

    public function selectApplicantLanguages($id, $applicant) {
        return $this->applicantLanguagesDAO->selectByIdAndApplicant($id, $applicant);
    }

    public function selectApplicantLanguagesById($id) {
        return $this->applicantLanguagesDAO->selectById($id);
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

    public function selectApplicantJobsById($id) {
        return $this->applicantJobsDAO->selectById($id);
    }

    public function saveApplicantJobs($applicantJobs) {
        $this->setJobCompany($applicantJobs);
        $this->applicantJobsDAO->create($applicantJobs);
    }

    public function updateApplicantJobs($applicantJobs) {
        $this->setJobCompany($applicantJobs);
        $this->applicantJobsDAO->update($applicantJobs);
    }

    public function deleteApplicantJobs($applicantJobs) {
        $this->applicantJobsDAO->remove($applicantJobs);
    }

    public function createNewApplicant($user) {

        $applicant = new Applicant();
        $applicant->setName('Sin especificar');
        $applicant->setSurname('Sin especificar');
        $applicant->setEmail($user->getEmail());
        $applicant->setWeb('http://linked.in');
        $applicant->setUser($user);
        return $this->entityDAO->create($applicant);
    }

    /**
     * @param $applicantStudies
     */
    private function setStudiesCenter($applicantStudies)
    {
        if (preg_match("/^[0-9]+$/", $applicantStudies->getCenterValue())) {
            // Check that exists
            if ($center = $this->centerDAO->selectById($applicantStudies->getCenterValue())) {
                $applicantStudies->setCenter($center);
            } else { // else, insert that number as the name
                $applicantStudies->setNewCenter();
            }
        } else { // Else, new Center must be created
            $center = new Center();
            $center->setName($applicantStudies->getCenterValue());
            $this->centerDAO->create($center);
            $applicantStudies->setCenter($center);
        }
    }

    /**
     * @param $applicantStudies
     */
    private function setStudiesStudies($applicantStudies)
    {
        if (preg_match("/^[0-9]+$/", $applicantStudies->getStudiesValue())) {
            // Check that exists
            if ($studies = $this->studiesDAO->selectById($applicantStudies->getStudiesValue())) {
                $applicantStudies->setStudies($studies);
            } else { // else, insert that number as the name
                $applicantStudies->setNewStudies();
            }
        } else { // Else, new Studies must be created
            $studies = new Studies();
            $studies->setName($applicantStudies->getStudiesValue());
            $this->studiesDAO->create($studies);
            $applicantStudies->setStudies($studies);
        }
    }

    /**
     * @param $applicantStudies
     */
    private function setJobCompany($applicantJob)
    {
        if (preg_match("/^[0-9]+$/", $applicantJob->getCompanyName())) {
            // Check that exists
            if ($company = $this->companyDAO->selectById($applicantJob->getCompanyName())) {
                $applicantJob->setCompany($company);
            } else { // else, insert that number as the name
                $applicantJob->setNewCompany();
            }
        } else { // Else, new Company must be created
            $company = new Company();
            $company->setEmpresa($applicantJob->getCompanyName());
            $this->companyDAO->create($company);
            $applicantJob->setCompany($company);
        }
    }
}
