<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\ApplicantRepository")
 * @ORM\Table(name="tbalumnos")
 */
class Applicant
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\Column(name="nombre",type="string", length=50)
     */
    private $name;
  
    /**
     * @ORM\Column(name="apellidos",type="string", length=50)
     */
    private $surname;
    
     /**
     * @ORM\Column(name="email",type="string", length=100)
     */
    private $email;
   
     /**
     * @ORM\Column(name="id_user",type="integer")
     */
    private $idUser;

    /**
     * //ORM\Column(name="estudiosrequeridos",type="array", length=50)
     */
    private $studies;
    
     /**
     * @ORM\Column(name="curriculum",type="string", length=255)
     */
    private $cv = '';

    
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
    
    public function getSurname() {
        return $this->surname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function getStudies() {
        return $this->studies;
    }
    
    public function getCv() {
        return $this->cv;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    public function setCv($cv) {
        $this->cv = $cv;
    }


    public function setStudies($studies) {
        $this->studies = $studies;
    }


}