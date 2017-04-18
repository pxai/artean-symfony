<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altad
 * MailingDAO
 * Extends GenericDAO
 */
class MailingDAO extends GenericDAO {

    public function findAllMailings($id=0, $start=0,$total=100)
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


    public function countAllMailings()
    {
        $repository = $this->em->getRepository($this->entityType);
        return $repository->createQueryBuilder('m')
            ->select('count(m.id)')
            ->from('CuatrovientosArteanBundle:Mailing','mailing')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchMailings($mailing, $start=0,$total=100)
    {
        $repository = $this->em->getRepository($this->entityType);
        $qb =  $repository->createQueryBuilder('m')
            ->where('m.body like :body')
            ->orgWhere('m.subject LIKE :subject')
            ->setParameter('body','%'.$mailing->getBody().'%')
            ->setParameter('subject','%'.$mailing->getSubject().'%')
            ->orderBy('m.id', 'DESC');


        return $qb->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }

}

