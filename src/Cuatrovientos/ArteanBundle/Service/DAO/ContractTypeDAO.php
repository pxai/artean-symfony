<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altad
 * ContractTypeDAO
 * Extends GenericDAO
 */
class ContractTypeDAO extends GenericDAO {

    public function findAllContractTypes($id=0, $start=0,$total=100)
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
    }


    public function countAllContractTypes()
    {
        $repository = $this->em->getRepository($this->entityType);
        return $repository->createQueryBuilder('m')
            ->select('count(m.id)')
            ->from('CuatrovientosArteanBundle:ContractType','contractType')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchContractTypes($contractType, $start=0,$total=100)
    {
        $repository = $this->em->getRepository($this->entityType);
        return  $repository->createQueryBuilder('m')
            ->where('m.name LIKE :name')
            ->setParameter('name','%'.$contractType->getName().'%')
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }

}

