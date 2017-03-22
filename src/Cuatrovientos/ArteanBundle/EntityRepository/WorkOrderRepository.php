<?php
// src/Cuatrovientos/BlogBundle/EntityRepository/OfferRepository.php

namespace Cuatrovientos\ArteanBundle\EntityRepository;
use Doctrine\ORM\EntityRepository;

class WorkOrderRepository extends EntityRepository
{

	/**
	* customized function
	*
	*/
	public function findAll()
	{
            return $this->findAll();
	}

    public function findDetail($id, $idaplicant)
    {
        return $this->find($id);
    }

}