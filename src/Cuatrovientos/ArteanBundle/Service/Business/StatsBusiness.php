<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;


class StatsBusiness extends GenericBusiness {


    public function getJobRequestsStats()
    {
        return $this->entityDAO->jobRequestStats();
    }


}
