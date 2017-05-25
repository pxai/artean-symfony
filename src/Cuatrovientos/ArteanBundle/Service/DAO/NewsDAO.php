<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altad
 * NewsDAO
 * Extends GenericDAO
 */
class NewsDAO extends GenericDAO {

    public function findAllNews($id=0, $start=0,$total=100)
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

    public function findAllPublishedNews($id=0, $start=0,$total=100)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.status=2')
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }

    public function findAllNewsByType($id=0)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.id > :id')
            ->andWhere('m.status = 2')
            ->setParameter('id',$id)
            ->orderBy('m.newsType', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findAllNewsByStatus($status=0)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.status = :status')
            ->setParameter('status',$status)
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findNews($term)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.title like :title')
            ->setParameter('title','%'.$term.'%')
            ->orderBy('m.title', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function countAllNews()
    {
        return $this->repository->createQueryBuilder('m')
            ->select('count(m.id)')
            ->from('CuatrovientosArteanBundle:News','news')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchNews($news, $start=0,$total=100)
    {
        return  $this->repository->createQueryBuilder('m')
            ->where('m.title LIKE :title')
            ->setParameter('title','%'.$news->getTitle().'%')
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }

}

