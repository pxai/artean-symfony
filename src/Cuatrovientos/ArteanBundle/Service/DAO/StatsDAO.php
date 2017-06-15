<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;
use Doctrine\ORM\Query\ResultSetMapping;
/**
 * Pello Altad
 * StatsDAO
 * Extends GenericDAO
 */
class StatsDAO extends GenericDAO {

    public function jobRequestStats($id=0, $start=0,$total=100)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('offeryear','offeryear');
        $rsm->addScalarResult('counter','counter');

        // Previous date conversion DATE_FORMAT(STR_TO_DATE(t.datestring, '%d/%m/%Y'), '%Y-%m-%d')
        return $this->em->createNativeQuery('SELECT year(j.fechasolicitud) AS offeryear, count(j.id) as counter FROM tbsolicitudes j GROUP BY offeryear  having offeryear > 0', $rsm)
            ->getResult();
    }

    public function jobRequestMonthlyStats($id=0, $start=0,$total=100)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('offermonth','offermonth');
        $rsm->addScalarResult('counter','counter');

        // Previous date conversion DATE_FORMAT(STR_TO_DATE(t.datestring, '%d/%m/%Y'), '%Y-%m-%d')
        return $this->em->createNativeQuery('SELECT month(j.fechasolicitud) AS offermonth, count(j.id) as counter FROM tbsolicitudes j GROUP BY offermonth  having offermonth > 0', $rsm)
            ->getResult();
    }

    public function applicantStats($id=0, $start=0,$total=100)
    {
        return $this->em->createQueryBuilder('m')
            ->select('j.id, count(j.id) as counter')
            ->from('CuatrovientosArteanBundle:JobRequest','j')
            ->groupby('j.offerdate')
            ->getQuery()
            ->getResult();
    }


}

