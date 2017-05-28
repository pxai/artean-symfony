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

    public function deleteSelectedApplicant($mailingid, $applicantid)
    {
        return $this->repository->createQueryBuilder('m')
            ->delete('Cuatrovientos\ArteanBundle\Entity\MailingSelectedApplicant', 's')
            ->where('s.mailing = :mailingid')
            ->andWhere('s.applicant = :applicantid')
            ->setParameter('mailingid', $mailingid)
            ->setParameter('applicantid', $applicantid)
            ->getQuery()->execute();
    }


    public function deleteAllSelectedApplicants($mailingid)
    {
        return $this->repository->createQueryBuilder('m')
            ->delete('Cuatrovientos\ArteanBundle\Entity\MailingSelectedApplicant', 's')
            ->where('s.mailing = :mailingid')
            ->setParameter('mailingid', $mailingid)
            ->getQuery()->execute();
    }

    public function deleteSelectedCompany($mailingid, $companyid)
    {
        return $this->repository->createQueryBuilder('m')
            ->delete('Cuatrovientos\ArteanBundle\Entity\MailingSelectedCompany', 's')
            ->where('s.mailing = :mailingid')
            ->andWhere('s.company = :companyid')
            ->setParameter('mailingid', $mailingid)
            ->setParameter('companyid', $companyid)
            ->getQuery()->execute();
    }


    public function deleteAllSelectedCompanies($mailingid)
    {
        return $this->repository->createQueryBuilder('m')
            ->delete('Cuatrovientos\ArteanBundle\Entity\MailingSelectedCompany', 's')
            ->where('s.mailing = :mailingid')
            ->setParameter('mailingid', $mailingid)
            ->getQuery()->execute();
    }

}

