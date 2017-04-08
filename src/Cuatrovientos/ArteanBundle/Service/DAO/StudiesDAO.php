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


    public function countAllStudies()
    {
        $repository = $this->em->getRepository($this->entityType);
        return $repository->createQueryBuilder('m')
            ->select('count(m.id)')
            ->from('CuatrovientosArteanBundle:Studies','studies')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchStudies($studies, $start=0,$total=100)
    {
        $repository = $this->em->getRepository($this->entityType);
        return  $repository->createQueryBuilder('m')
            ->where('m.name LIKE :name')
            ->setParameter('name','%'.$studies->getName().'%')
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }

}

