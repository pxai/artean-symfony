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


    public function countAllCenters()
    {
        $repository = $this->em->getRepository($this->entityType);
        return $repository->createQueryBuilder('m')
            ->select('count(m.id)')
            ->from('CuatrovientosArteanBundle:Center','center')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchCenters($center, $start=0,$total=100)
    {
        $repository = $this->em->getRepository($this->entityType);
        return  $repository->createQueryBuilder('m')
            ->where('m.cif like :cif')
            ->andWhere('m.nombre LIKE :nombre')
            ->setParameter('nombre','%'.$center->getName().'%')
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }

}

