<?php
// src/Cuatrovientos/BlogBundle/EntityRepository/NewsRepository.php

namespace Cuatrovientos\ArteanBundle\EntityRepository;

use Doctrine\ORM\EntityRepository;

class CompanyRepository extends EntityRepository
{
        /**
	* customized findApplicant
	*/
	public function findAllCompanies()
	{
              
            return $this->findAll();
	}

}