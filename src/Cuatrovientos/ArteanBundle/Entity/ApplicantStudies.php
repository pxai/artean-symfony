<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbalumnosestudios")
 */
class ApplicantStudies extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\Column(name="idapplicant",type="integer")
     */
    private $idapplicant;
  
     /**
     * @ORM\Column(name="codestudios",type="integer")
     */
    private $idstudies;

    /**
     * @ORM\Column(name="descripcion",type="string", length=100)
     */
    private $description;
    
    /**
     * @ORM\Column(name="codcentro",type="integer")
     */
    private $idcenter;

    /**
     * @ORM\Column(name="anofin",type="integer")
     */
    private $endyear;


    public function __construct () {
    }

    public function getId() {
        return $this->id;
    }

    public function getIdapplicant() {
        return $this->idapplicant;
    }

    public function getIdstudies() {
        return $this->idstudies;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getIdcenter() {
        return $this->idcenter;
    }

    public function getEndyear() {
        return $this->endyear;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdapplicant($idapplicant) {
        $this->idapplicant = $idapplicant;
    }

    public function setIdstudies($idstudies) {
        $this->idstudies = $idstudies;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setIdcenter($idcenter) {
        $this->idcenter = $idcenter;
    }

    public function setEndyear($endyear) {
        $this->endyear = $endyear;
    }



   
}