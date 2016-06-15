<?php
// src/Cuatrovientos/BlogBundle/EntityRepository/NewsRepository.php

namespace Cuatrovientos\ArteanBundle\EntityRepository;

use Doctrine\ORM\EntityRepository;
use Cuatrovientos\ArteanBundle\Entity\News;

class UserRepository extends EntityRepository
{


    
        /**
	* customized findApplicant
	*/
	public function findUser($email)
	{
              
            $user = $this->findOneBy(array("email" => $email));
            return $user;
	}
        
        /**
	* check login for user findApplicant
	*/
	public function checkLogin($new_user)
	{
            
            $user = $this->findOneBy(array("login"=> $new_user->getLogin(), "password" => $new_user->getPassword()));
            return $user;
	}
        
        /**
	* save offer as news function
	*
	*/
	public function saveNewUser($user)
	{
            
            $news = new News();
            $news->setTitle($offer->getCompany(). ' ' . $offer->getPosition());
            $news->setWhat($offer->getDescription());
             
            //$em = $this->getDoctrine()->getEntityManager();
            $this->insert($news);
            $this->flush();
	}
}