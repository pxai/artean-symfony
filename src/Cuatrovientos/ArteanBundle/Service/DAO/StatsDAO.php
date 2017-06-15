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
            ->select('j.id, count(j.id) as counter')
            ->from('CuatrovientosArteanBundle:JobRequest','j')
            ->groupby('j.offerdate')
            ->getQuery()
            ->getResult();
    }


    public function applicantStats($id=0, $start=0,$total=100)
    {
        return $this->repository->createQueryBuilder('m')
            ->select('j.id, count(j.id) as counter')
            ->from('CuatrovientosArteanBundle:JobRequest','j')
            ->groupby('j.offerdate')
            ->getQuery()
            ->getResult();
    }


}

