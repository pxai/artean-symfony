<?php
// src/Cuatrovientos/BlogBundle/EntityRepository/OfferOpenRepository.php

namespace Cuatrovientos\ArteanBundle\EntityRepository;

use Doctrine\ORM\EntityRepository;
use Cuatrovientos\ArteanBundle\Entity\OfferOpen;

class OfferOpenRepository extends EntityRepository
{

	/**
	* customized function
	*/
	public function findOffers()
	{
            return $this->findBy(array(), array('id'=>'desc'));
	}

}