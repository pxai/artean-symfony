<?php
// src/Cuatrovientos/BlogBundle/EntityRepository/NewsRepository.php

namespace Cuatrovientos\ArteanBundle\EntityRepository;

use Doctrine\ORM\EntityRepository;
use Cuatrovientos\ArteanBundle\Entity\News;

class NewsRepository extends EntityRepository
{

    
    	/**
	* customized function
	*
	*/
	public function findNews($post_id=0)
	{
            return $this->findBy(array(), array('newsdate' => 'DESC'));
	}
        
	/**
	* customized function
	*
	*/
	public function findPublicNews($post_id=0)
	{
            return $this->findBy(array('status'=>array(1,2)), array('newsdate' => 'DESC'));
	}
        
        /**
	* save offer as news function
	*
	*/
	public function saveOfferAsNews ($offer)
	{
            
            $news = new News();
            $news->setTitle($offer->getCompany(). ' ' . $offer->getPosition());
            $news->setWhat($offer->getDescription());
             
            //$em = $this->getDoctrine()->getEntityManager();
            $this->insert($news);
            $this->flush();
	}
}