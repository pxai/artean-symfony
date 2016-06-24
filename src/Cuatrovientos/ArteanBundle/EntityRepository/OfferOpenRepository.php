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
        
        /**
         * finds just one offer
         * @param type $id
         * @return type
         */
        public function findOffer($id) {
            return $this->findOneBy(array('id'=>$id));            
        }

}