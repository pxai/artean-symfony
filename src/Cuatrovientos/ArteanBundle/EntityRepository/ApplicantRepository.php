<?php
// src/Cuatrovientos/BlogBundle/EntityRepository/CenterRepository.php

namespace Cuatrovientos\ArteanBundle\EntityRepository;
use Doctrine\ORM\EntityRepository;

class ApplicantRepository extends EntityRepository
{

        
       /**
	* customized findApplicant
	*/
	public function findApplicant($email)
	{
              
            $applicant = $this->findOneBy(array("email" => $email));
            return $applicant;
	}
}