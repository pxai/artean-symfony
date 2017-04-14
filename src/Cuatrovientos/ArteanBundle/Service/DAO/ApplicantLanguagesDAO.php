<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altadill
 * ApplicantStudiesDAO
 * Extends GenericDAO
 */
class ApplicantLanguagesDAO extends GenericDAO {


    public function selectByIdAndApplicant($id, $applicant)
    {
        $repository = $this->em->getRepository($this->entityType);
        return $repository->createQueryBuilder('a')
            ->where('a.id = :id')
            ->andWhere('a.applicant = :applicant')
            ->setParameter('id',$id)
            ->setParameter('applicant',$applicant)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

