<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altad
 * CenterDAO
 * Extends GenericDAO
 */
class CenterDAO extends GenericDAO {

    public function findAllCenters($id=0, $start=0,$total=100)
    {
        return $this->repository->createQueryBuilder('m')
        ->where('m.id > :id')
        ->setParameter('id',$id)
        ->orderBy('m.id', 'DESC')
        ->getQuery()
        ->setFirstResult($start)
        ->setMaxResults($total)
        ->getResult();
    }

    public function findCenters($term)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.name like :name')
            ->setParameter('name','%'.$term.'%')
            ->orderBy('m.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function countAllCenters()
    {
        return $this->repository->createQueryBuilder('m')
            ->select('count(m.id)')
            ->from('CuatrovientosArteanBundle:Center','center')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchCenters($center, $start=0,$total=100)
    {
        return  $this->repository->createQueryBuilder('m')
            ->where('m.name LIKE :name')
            ->setParameter('name','%'.$center->getName().'%')
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }

}

