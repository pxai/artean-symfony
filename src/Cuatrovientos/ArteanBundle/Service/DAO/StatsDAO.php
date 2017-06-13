<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altad
 * StatsDAO
 * Extends GenericDAO
 */
class StatsDAO extends GenericDAO {

    public function jobRequestStats($id=0, $start=0,$total=100)
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




}

