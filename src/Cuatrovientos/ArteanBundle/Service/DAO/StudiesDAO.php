<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altad
 * StudiesDAO
 * Extends GenericDAO
 */
class StudiesDAO extends GenericDAO {

    public function findAllStudies($id=0, $start=0,$total=100)
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

    public function findStudies($term)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.name like :name')
            ->orWhere('m.description like :name')
            ->setParameter('name','%'.$term.'%')
            ->orderBy('m.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function countAllStudies()
    {
        return $this->repository->createQueryBuilder('m')
            ->select('count(m.id)')
            ->from('CuatrovientosArteanBundle:Studies','studies')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchStudies($studies, $start=0,$total=100)
    {
        return  $this->repository->createQueryBuilder('m')
            ->where('m.name LIKE :name')
            ->setParameter('name','%'.$studies->getName().'%')
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }

}

