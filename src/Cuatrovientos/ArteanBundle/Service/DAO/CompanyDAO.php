<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altad
 * MessageDAO
 * Extends GenericDAO
 */
class CompanyDAO extends GenericDAO {

    public function findAllCompanies($id=0, $start=0,$total=100)
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


    public function countAllCompanies()
    {
        $repository = $this->em->getRepository($this->entityType);
        return $repository->createQueryBuilder('m')
            ->select('count(m.id)')
            ->from('CuatrovientosArteanBundle:Company','company')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchCompanies($company, $start=0,$total=100)
    {
        $repository = $this->em->getRepository($this->entityType);
        $qb =  $repository->createQueryBuilder('m')
            ->where('m.cif like :cif')
            ->andWhere('m.empresa LIKE :empresa')
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

}

