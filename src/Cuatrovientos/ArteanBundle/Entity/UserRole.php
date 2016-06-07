<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="f_users_has_roles")
 */
class UserRole
{
    /**
     * @ORM\Id
     * @ORM\Column(name="iduser",type="integer")
     */
    private $iduser;
    
     /**
     * @ORM\Id
     * @ORM\Column(name="idrole",type="integer")
     */
    private $idrole;
  
  

    public function __construct () {
    }

    public function getIduser() {
        return $this->iduser;
    }

    public function getIdrole() {
        return $this->idrole;
    }

    public function setIduser($iduser) {
        $this->iduser = $iduser;
    }

    public function setIdrole($idrole) {
        $this->idrole = $idrole;
    }


   
}