<?php
// src/Cuatrovientos/BlogBundle/EntityRepository/OfferRepository.php

namespace Cuatrovientos\ArteanBundle\EntityRepository;
use Doctrine\ORM\EntityRepository;

class WorkOrderRepository extends EntityRepository
{


    /**
	* customized function
	*
	*/
	public function findAllOrders($idapplicant)
	{
            return $this->findBy(array("idapplicant"=>$idapplicant));
	}


    /**
     * customized function
     *
     */
    public function findOrdersInDateRange($from, $to, $idapplicant)
    {
        $workOrders = $this->createQueryBuilder('wo')
            ->where('wo.idapplicant=:idapplicant and wo.orderDate >= :from and wo.orderDate <= :to')
            ->setParameters(array('from' => $from, 'to' => $to, 'idapplicant' => $idapplicant ))
            ->getQuery()
            ->getResult();
        return $workOrders;
    }

    public function findDetail($id, $idaplicant)
    {
        return $this->find($id);
    }

}