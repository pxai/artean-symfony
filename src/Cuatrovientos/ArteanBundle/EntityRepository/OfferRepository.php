<?php
// src/Cuatrovientos/BlogBundle/EntityRepository/OfferRepository.php

namespace Cuatrovientos\ArteanBundle\EntityRepository;
use Doctrine\ORM\EntityRepository;

class OfferRepository extends EntityRepository
{

	/**
	* customized function
	*
	*/
	public function findOffer($post_id=0)
	{
            return $this->findAll();
	}
}