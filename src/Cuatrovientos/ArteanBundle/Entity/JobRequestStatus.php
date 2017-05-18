<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbsolicitudes_estado")
 */
class JobRequestStatus extends Entity
{
    const INIT = 1;
    const PRESELECTED = 2;
    const SELECTED = 3;
    const MAIL_SENT = 4;
    const ASSESMENT_DONE = 5;

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
        $values = array("INICIADA","INICIADA","PRESELECCIÓN","SELECCIÓN","EMAIL ENVIADO","VALORADO");
        $this->id = $default;
        $this->name = $values[$default];
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