<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\WorkOrder;
use Cuatrovientos\ArteanBundle\Service\DAO\WorkOderDAO;


class WorkOrderBusiness extends GenericBusiness {

    public function findAllOrders($userid)
    {
        return $this->entityDAO->findAllOrders($userid);
    }

    public function findOrdersInDateRange($from, $to, $idapplicant)
    {
        return $this->entityDAO->findOrdersInDateRange($from, $to, $idapplicant);
    }

    public function findDetail($id, $idapplicant)
    {
        return $this->entityDAO->findDetail($id, $idapplicant);
    }


}
