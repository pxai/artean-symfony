<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altad
 * ApplicantDAO
 * Extends GenericDAO
 */
class ApplicantDAO extends GenericDAO {

    public function findAllApplicants($id=0, $start=0,$total=100)
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


    public function countAllApplicants()
    {
        return $this->repository->createQueryBuilder('m')
            ->select('count(m.id)')
            ->from('CuatrovientosArteanBundle:Applicant','applicant')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchApplicants($applicant, $start=0,$total=100)
    {
        return  $this->repository->createQueryBuilder('m')
            ->where('m.name LIKE :name')
            ->andWhere('m.surname like :surname')
            ->setParameter('name','%'.$applicant->getName().'%')
            ->setParameter('surname','%'.$applicant->getSurname().'%')
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }
    
    public function findAllApplicantData($id)
    {
        $repository = $this->em->getRepository($this->entityType);
        return $repository->createQueryBuilder('a')
            ->where('a.id = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAllApplicantDataByUserId ($userid)
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

    public function detailedSearchApplicants($applicant)
    {
        $repository = $this->em->getRepository($this->entityType);
        return $repository->createQueryBuilder('m')
            ->leftJoin('m.languages','l','language')
            ->where('m.name LIKE :name')
            ->andWhere('m.surname like :surname')
            ->andWhere('m.drivingLicense like :drivingLicense')
            ->andWhere('m.move like :move')
             ->andWhere('l.language IN (:languages)')
             ->setParameter('languages', $applicant->getLanguages())
        ->setParameter('name','%'.$applicant->getName().'%')
            ->setParameter('surname','%'.$applicant->getSurname().'%')
            ->setParameter('drivingLicense','%'.$applicant->getDrivingLicense().'%')
            ->setParameter('move','%'.$applicant->getMove().'%')
            ->orderBy('m.surname', 'ASC')
            ->getQuery()
            ->getResult();
    }


}

