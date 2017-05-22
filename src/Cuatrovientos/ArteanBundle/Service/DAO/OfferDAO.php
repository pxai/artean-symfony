<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altad
 * OfferDAO
 * Extends GenericDAO
 */
class OfferDAO extends GenericDAO {

    public function findAllOffers($id=0, $start=0,$total=100)
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

    public function findAllOffersByStatus($status=0)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.published = :status')
            ->setParameter('status',$status)
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findAllOffersByType($id=0)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.id > :id')
            ->andWhere('m.status = 2')
            ->setParameter('id',$id)
            ->orderBy('m.offerType', 'DESC')
            ->getQuery()
            ->getResult();
    }
    public function findOffers($term)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.name like :name')
            ->setParameter('name','%'.$term.'%')
            ->orderBy('m.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function countAllOffers()
    {
        return $this->repository->createQueryBuilder('m')
            ->select('count(m.id)')
            ->from('CuatrovientosArteanBundle:Offer','offer')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchOffers($offer, $start=0,$total=100)
    {
        return  $this->repository->createQueryBuilder('m')
            ->where('m.name LIKE :name')
            ->setParameter('name','%'.$offer->getName().'%')
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }

}

