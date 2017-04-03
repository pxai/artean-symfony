<?php
// src/Cuatrovientos/BlogBundle/EntityRepository/NewsRepository.php

namespace Cuatrovientos\ArteanBundle\EntityRepository;

use Doctrine\ORM\EntityRepository;

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

}