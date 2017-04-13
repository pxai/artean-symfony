<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altad
 * ApplicantDAO
 * Extends GenericDAO
 */
class ApplicantDAO extends GenericDAO {

    public function findAllApplicantData($userid)
    {
        $repository = $this->em->getRepository($this->entityType);
        return $repository->createQueryBuilder('a')
            ->where('a.idUser = :id')
            ->setParameter('id',$userid)
            ->getQuery()
            ->getOneOrNullResult();
    }


   /* public function findAllCompanies($id=0, $start=0,$total=100)
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
    }*/



}

