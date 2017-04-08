<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\ContractType;
use Cuatrovientos\ArteanBundle\Service\DAO\ContractTypeDAO;


class ContractTypeBusiness extends GenericBusiness {

    public function findAllContractTypes($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllContractTypes($id, $start,$total);
    }


    public function countAllContractTypes()
    {
        return $this->entityDAO->countAllContractTypes();
    }

    public function searchContractTypes($contractType, $start=0,$total=100)
    {
        return $this->entityDAO->searchContractTypes($contractType, $start, $total);
    }

}
