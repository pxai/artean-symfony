<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;


class StatsBusiness extends GenericBusiness {


    public function getJobRequestsStats()
    {
        return json_encode($this->entityDAO->jobRequestStats());
    }

    public function getJobRequestMonthlyStats()
    {
        return json_encode($this->entityDAO->jobRequestMonthlyStats());
    }


    public function getApplicantStats()
    {
        return $this->entityDAO->applicantStats();
    }

}
