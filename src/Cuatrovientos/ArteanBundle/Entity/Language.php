<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbidiomas")
 */
class Language extends Entity
{
    /**
     * @ORM\Column(name="Codidioma",type="string")
     * @ORM\Id
     */
    private $id;
    
     /**
     * @ORM\Column(name="Idioma",type="string", length=50)
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

    function __toString()
    {
        return $this->getName();
    }
}