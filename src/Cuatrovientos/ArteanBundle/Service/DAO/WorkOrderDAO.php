<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altad
 * MessageDAO
 * Extends GenericDAO
 */
class WorkOrderDAO extends GenericDAO {

    public function findAllOrders($userid)
    {
        $repository = $this->em->getRepository($this->entityType);
        return $repository->findBy(array("idapplicant"=>$userid));
    }

    /**
     * customized function
     *
     */
    public function findOrdersInDateRange($from, $to, $idapplicant)
    {
        $repository = $this->em->getRepository($this->entityType);
        $workOrders = $repository->createQueryBuilder('wo')
            ->where('wo.idapplicant=:idapplicant and wo.orderDate >= :from and wo.orderDate <= :to')
            ->setParameters(array('from' => $from, 'to' => $to, 'idapplicant' => $idapplicant ))
            ->getQuery()
            ->getResult();
        return $workOrders;
    }

    public function findDetail($id, $idapplicant)
    {
        $repository = $this->em->getRepository($this->entityType);
        $workOrders = $repository->createQueryBuilder('wo')
            ->where('wo.id =:id and wo.idapplicant=:idapplicant')
            ->setParameters(array('id' => $id, 'idapplicant' => $idapplicant ))
            ->getQuery()
            ->getResult();
        return $workOrders;
    }


   /* public function findAllCompanies($id=0, $start=0,$total=100)
    {
        $repository = $this->em->getRepository($this->entityType);
        return $repository->createQueryBuilder('m')
        ->where('m.id > :id')
        ->setParameter('id',$id)
        ->orderBy('m.id', 'DESC')
        ->getQuery()
        ->setFirstResult($start)
        ->setMaxResults($total)
        ->getResult();
    }*/



}

