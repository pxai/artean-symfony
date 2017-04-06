<?php
// src/Cuatrovientos/BlogBundle/EntityRepository/NewsRepository.php

namespace Cuatrovientos\ArteanBundle\EntityRepository;

use Doctrine\ORM\EntityRepository;
use Cuatrovientos\ArteanBundle\Entity\Company;

class CompanyRepository extends EntityRepository
{
    /**
	* customized findApplicant
	*/
	public function findAllCompanies($id=0, $start=0,$total=100)
	{
        return $this->createQueryBuilder('m')
            ->where('m.id > :id')
            ->setParameter('id',$id)
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
	}


    /**
     * counts all companies
     */
    public function countAllCompanies()
    {
        return $this->createQueryBuilder('m')
            ->select('count(m.id)')
            ->from('CuatrovientosArteanBundle:Company','company')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchCompanies(Company $company, $start=0,$total=100)
    {

        $qb =  $this->createQueryBuilder('m')
             ->where('m.cif like :cif')
            ->andWhere('m.empresa LIKE :empresa')
            ->setParameter('cif','%'.$company->getCif().'%')
            ->setParameter('empresa','%'.$company->getEmpresa().'%')
            ->orderBy('m.id', 'DESC');

            if ($company->getFct()) {
                $qb->andWhere('m.fct <> 1');
            }

            if ($company->getConvenio()) {
                $qb->andWhere('m.convenio is not null');
            }

            return $qb->getQuery()
        ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }

}