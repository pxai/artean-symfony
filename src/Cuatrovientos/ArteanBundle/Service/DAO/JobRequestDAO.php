<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altad
 * MessageDAO
 * Extends GenericDAO
 */
class JobRequestDAO extends GenericDAO {

    public function findAllJobRequests($id=0, $start=0,$total=100)
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

    public function findJobRequests($term)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.company like :name')
            ->setParameter('name','%'.$term.'%')
            ->orderBy('m.company', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findJobRequestsByStatus($status, $start=0,$total=100)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.status =:status')
            ->setParameter('status',$status)
            ->orderBy('m.offerdate', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function countAllJobRequests()
    {
        return $this->repository->createQueryBuilder('m')
            ->select('count(m.id)')
            ->from('CuatrovientosArteanBundle:JobRequest','jobRequest')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchJobRequest($company, $start=0,$total=100)
    {
        $qb =  $this->repository->createQueryBuilder('m')
            ->where('m.cif like :cif')
            ->andWhere('m.company LIKE :empresa')
            ->setParameter('cif','%'.$company->getCif().'%')
            ->setParameter('empresa','%'.$company->getEmpresa().'%')
            ->orderBy('m.id', 'DESC');

        if ($company->getFct()) {
            $qb->andWhere('m.fct <> 1');
        }

        if ($company->getConvenio()) {
            $qb->andWhere("m.convenio is not null or m.convenio <> ''");
        }

        return $qb->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }

    public function deletePreselected($jobrequestid, $applicantid)
    {
        return $this->repository->createQueryBuilder('m')
            ->delete('Cuatrovientos\ArteanBundle\Entity\JobRequestPreselected', 's')
            ->where('s.jobRequest = :jobrequestid')
            ->andWhere('s.applicant = :applicantid')
            ->setParameter('jobrequestid', $jobrequestid)
            ->setParameter('applicantid', $applicantid)
            ->getQuery()->execute();
    }

    public function deleteSelected($jobrequestid, $applicantid)
    {
        return $this->repository->createQueryBuilder('m')
            ->delete('Cuatrovientos\ArteanBundle\Entity\JobRequestSelected', 's')
            ->where('s.jobRequest = :jobrequestid')
            ->andWhere('s.applicant = :applicantid')
            ->setParameter('jobrequestid', $jobrequestid)
            ->setParameter('applicantid', $applicantid)
            ->getQuery()->execute();
    }

    public function deleteAllPreselected($jobrequestid)
    {
        return $this->repository->createQueryBuilder('m')
            ->delete('Cuatrovientos\ArteanBundle\Entity\JobRequestPreselected', 's')
            ->where('s.jobRequest = :jobrequestid')
            ->setParameter('jobrequestid', $jobrequestid)
            ->getQuery()->execute();
    }

    public function deleteAllSelected($jobrequestid)
    {
        return $this->repository->createQueryBuilder('m')
            ->delete('Cuatrovientos\ArteanBundle\Entity\JobRequestSelected', 's')
            ->where('s.jobRequest = :jobrequestid')
            ->setParameter('jobrequestid', $jobrequestid)
            ->getQuery()->execute();
    }

}

