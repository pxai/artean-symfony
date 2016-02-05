<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\CenterRepository")
 * @ORM\Table(name="tbcentros")
 */
class Center
{
    /**
     * @ORM\Column(name="codcentro",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\Column(name="nombrecentro",type="string", length=50)
     */
    private $name;
  
  

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