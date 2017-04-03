<?php
// src/Cuatrovientos/BlogBundle/EntityRepository/NewsRepository.php

namespace Cuatrovientos\ArteanBundle\EntityRepository;

use Doctrine\ORM\EntityRepository;

class FctRepository extends EntityRepository
{
        /**
	* customized findApplicant
	*/
	public function findAllFcts()
	{
              
            return $this->findAll();
	}

}