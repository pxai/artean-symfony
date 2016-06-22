<?php
// src/Cuatrovientos/BlogBundle/EntityRepository/CenterRepository.php

namespace Cuatrovientos\ArteanBundle\EntityRepository;
use Doctrine\ORM\EntityRepository;

class CenterRepository extends EntityRepository
{

	/**
	* customized function
	*
	*/
	public function findApplicant($post_id=0)
	{
            return $this->findAll();
	}
}