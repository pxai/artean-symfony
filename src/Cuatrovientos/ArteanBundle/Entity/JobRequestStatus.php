<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbsolicitudes_estado")
 */
class JobRequestStatus extends Entity
{
    const INIT = "INICIADO";
    const PRESELECTED = "PRESELECCIÓN";
    const SELECTED = "SELECCIÓN";
    const MAIL_SENT = "EMAIL ENVIADO";
    const ASSESMENT_DONE = "VALORADO";

    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\Column(name="name",type="string", length=50)
     */
    private $name = "";

    /**
     * @ORM\Column(name="description",type="string", length=50)
     */
    private $description;

    public function __construct ($default = 1) {
      $this->id = $default;

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

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * Necessary to render data in the choice control.
     * @return type
     */
    public function __toString() {
    return $this->name;
}
   
}