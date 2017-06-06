<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altad
 * OfferDAO
 * Extends GenericDAO
 */
class OfferAdDAO extends GenericDAO {

    public function findAllOfferAds($id=0, $start=0,$total=100)
    {
        return $this->repository->createQueryBuilder('m')
        ->where('m.id > :id')
            ->andWhere('m.type =  1')
        ->setParameter('id',$id)
        ->orderBy('m.id', 'DESC')
        ->getQuery()
        ->setFirstResult($start)
        ->setMaxResults($total)
        ->getResult();
    }

    public function findAllPublishedOfferAds($id=0, $start=0,$total=100)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.id > :id')
            ->andWhere('m.published=6')
            ->andWhere('m.type =  1')
            ->setParameter('id',$id)
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }

    public function findAllOfferAdsByStatus($status=0)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.published = :status')
            ->andWhere('m.type =  1')
            ->setParameter('status',$status)
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findAllOfferAdsByType($id=0)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.id > :id')
            ->andWhere('m.status = 2')
            ->andWhere('m.type =  1')
            ->setParameter('id',$id)
            ->orderBy('m.offerType', 'DESC')
            ->getQuery()
            ->getResult();
    }
    public function findOfferAds($term)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.name like :name')
            ->andWhere('m.type =  1')
            ->setParameter('name','%'.$term.'%')
            ->orderBy('m.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function countAllOfferAds()
    {
        return $this->repository->createQueryBuilder('m')
            ->select('count(m.id)')
            ->from('CuatrovientosArteanBundle:Offer','offer')
            ->where('m.type =  1')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchOfferAds($offer, $start=0,$total=100)
    {
        return  $this->repository->createQueryBuilder('m')
            ->where('m.name LIKE :name')
            ->andWhere('m.type =  1')
            ->setParameter('name','%'.$offer->getName().'%')
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }


}

