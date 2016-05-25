<?php
// src/Cuatrovientos/BlogBundle/EntityRepository/OfferAdRepository.php

namespace Cuatrovientos\ArteanBundle\EntityRepository;
use Doctrine\ORM\EntityRepository;

class OfferAdRepository extends EntityRepository
{

	/**
	* customized function
	*
	*/
	public function findOffer($post_id=0)
	{
            return $this->findAll();
	}
        
       /**
	* customized function
	*
	*/
	public function saveOfferAsNew ($offer)
	{
            return $this->findAll();
	}
}