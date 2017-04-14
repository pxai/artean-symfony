<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\StudiesRepository")
 * @ORM\Table(name="tbestudios")
 */
class Studies extends Entity
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="codestudios",type="string", length=50)
     */
    private $name;

     /**
     * @ORM\Column(name="descripcion",type="string", length=100)
     */
    private $description;

    public function __construct () {
    }

    public function getId () {
      return $this->id;  
    }

    public function setId ($id) {
        $this->id = $id;
        return $this;
    }


    public function getName () {
      return $this->name;  
    }
    

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    function __toString()
    {
        return $this->getName();
    }


}