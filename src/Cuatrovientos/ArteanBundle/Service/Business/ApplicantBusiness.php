<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantDAO;


class ApplicantBusiness extends GenericBusiness {

    public function findAllApplicantData($userid)
    {
        return $this->entityDAO->findAllApplicantData($userid);
    }

}
