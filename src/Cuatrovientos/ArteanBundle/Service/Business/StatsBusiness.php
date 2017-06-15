<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;


class StatsBusiness extends GenericBusiness {


    public function getJobRequestsStats()
    {
        return json_encode($this->entityDAO->jobRequestStats());
    }

    public function getApplicantStats()
    {
        return $this->entityDAO->applicantStats();
    }

}
