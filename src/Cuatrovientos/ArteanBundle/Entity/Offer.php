<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\OfferRepository")
 * @ORM\Table(name="tboffer")
 */
class Offer
{
    /**
     * @ORM\Column(name="codcentro",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\Column(name="company",type="string", length=50)
     */
    private $company;
  
     /**
     * @ORM\Column(name="position",type="string", length=50)
     */
    private $position;
  
         /**
     * @ORM\Column(name="functions",type="string", length=50)
     */
    private $functions;
    
         /**
     * @ORM\Column(name="position_no",type="string", length=50)
     */
    private $position_no;

     /**
     * @ORM\Column(name="workday",type="string", length=50)
     */
    private $workday;

    /**
     * @ORM\Column(name="required_studies",type="string", length=50)
     */
    private $required_studies;
    
    /**
     * @ORM\Column(name="required_languages",type="string", length=50)
     */
    private $required_languages;

    /**
     * @ORM\Column(name="other_knowledges",type="string", length=50)
     */
    private $other_knowledges;
    
    /**
     * @ORM\Column(name="observations",type="string", length=50)
     */
    private $observations;
    
    /**
     * @ORM\Column(name="contact",type="string", length=50)
     */
    private $contact;
    
    public function __construct () {
    }

    /**
    *
    */
    public function getId () {
      return $this->id;  
    }
    
    /**
    *
    */
    public function setId ($id) {
        $this->id = $id;
        return $this;
    }

    
    /**
    *
    */
    public function getName () {
      return $this->name;  
    }
    
    /**
    *
    */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
   
}