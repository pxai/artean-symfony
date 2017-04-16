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

    public function findApplicants($term)
    {
        $repository = $this->em->getRepository('CuatrovientosArteanBundle:ApplicantSimple');
        return $repository->createQueryBuilder('m')
            ->where('m.name like :name')
            ->orWhere('m.surname like :name')
            ->setParameter('name','%'.$term.'%')
            ->orderBy('m.surname', 'ASC')
            ->getQuery()
            ->getResult();
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

