<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altad
 * PageDAO
 * Extends GenericDAO
 */
class PageDAO extends GenericDAO {

    public function findAllPages($id=0, $start=0,$total=100)
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

    public function findAllPagesByType($id=0)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.id > :id')
            ->andWhere('m.status = 2')
            ->setParameter('id',$id)
            ->orderBy('m.pageType', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findPageByPermalink($permalink) {
        return $this->repository->createQueryBuilder('m')
            ->where('m.permalink = :permalink')
            ->setParameter('permalink',$permalink)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findPages($term)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.name like :name')
            ->setParameter('name','%'.$term.'%')
            ->orderBy('m.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function countAllPages()
    {
        return $this->repository->createQueryBuilder('m')
            ->select('count(m.id)')
            ->from('CuatrovientosArteanBundle:Page','page')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchPages($page, $start=0,$total=100)
    {
        return  $this->repository->createQueryBuilder('m')
            ->where('m.name LIKE :name')
            ->setParameter('name','%'.$page->getName().'%')
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }

}

