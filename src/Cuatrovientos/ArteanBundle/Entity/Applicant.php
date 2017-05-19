<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Count;

/**
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\ApplicantRepository")
 * @ORM\Table(name="tbalumnos")
 */
class Applicant extends Entity
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\Column(name="nombre",type="string", length=100)
     */
    private $name;
  
    /**
     * @ORM\Column(name="apellidos",type="string", length=100)
     */
    private $surname;
    
     /**
     * @ORM\Column(name="telefonomovil",type="string", length=100)
     */
    private $mobile;

    
     /**
     * @ORM\Column(name="email",type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(name="web",type="string", length=100)
     */
    private $web;
   
     /**
     * @ORM\Column(name="id_user",type="integer")
     */
    private $idUser;

    /**
     * @ORM\Column(name="direccion",type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(name="localidad",type="string", length=50)
     */
    private $city;

    /**
     * @ORM\Column(name="provincia",type="string", length=20)
     */
    private $province;

    /**
     * @ORM\Column(name="codpostal",type="string", length=10)
     */
    private $postalCode;

    /**
     * @ORM\Column(name="telefono",type="string", length=100)
     */
    private $phone;

    /**
     * @ORM\Column(name="carneconducir",type="string", length=10)
     * update tbalumnos set carneconducir=1 where carneconducir='VERDADERO'
     * update tbalumnos set carneconducir=0 where carneconducir='FALSO'
     */
    private $drivingLicense;

    /**
     * @ORM\Column(name="desplazamiento",type="string", length=10)
     * update tbalumnos set desplazamiento=0 where desplazamiento='FALSO'
     * update tbalumnos set desplazamiento=1 where desplazamiento='VERDADERO'
     */
    private $move;

    /**
     * @ORM\Column(name="fechanacimiento",type="string", length=20)
     */
    private $birth;

    /**
     * @ORM\Column(name="resumen",type="string")
     */
    private $resume;

     /**
     * @ORM\Column(name="curriculum",type="string", length=255)
     */
    private $cv = '';

    
    private $lopd;

    /**
     * @ORM\OneToMany(targetEntity="ApplicantStudies", mappedBy="applicant",fetch="EXTRA_LAZY")
     */
    private $studies;

    /**
     * @ORM\OneToMany(targetEntity="ApplicantLanguages", mappedBy="applicant",fetch="EXTRA_LAZY")
     */
    private $languages;

    /**
     * @ORM\OneToMany(targetEntity="ApplicantJobs", mappedBy="applicant",fetch="EXTRA_LAZY")
     */
    private $jobs;

    /**
     * @ORM\OneToMany(targetEntity="JobRequestPreselected", mappedBy="jobRequest",fetch="EXTRA_LAZY")
     */
    private $jobOffers;

    private $courses;

    /**
     * @ORM\Column(name="sel",type="integer")
     */
    private $active = 0;

    public function __construct () {
        $this->studies = array();
        $this->courses = array();
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

    public function getLopd() {
        return $this->lopd;
    }

    public function setLopd($lopd) {
        $this->lopd = $lopd;
    }

    public function getMobile() {
        return $this->mobile;
    }

    public function setMobile($mobile) {
        $this->mobile = $mobile;
    }

    /**
     * @return mixed
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * @param mixed $web
     */
    public function setWeb($web)
    {
        $this->web = $web;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @param mixed $province
     */
    public function setProvince($province)
    {
        $this->province = $province;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getDrivingLicense()
    {
        return $this->drivingLicense;
    }

    /**
     * @param mixed $drivingLicense
     */
    public function setDrivingLicense($drivingLicense)
    {
        $this->drivingLicense = $drivingLicense;
    }

    /**
     * @return mixed
     */
    public function getMove()
    {
        return $this->move;
    }

    /**
     * @param mixed $move
     */
    public function setMove($move)
    {
        $this->move = $move;
    }

    /**
     * @return mixed
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * @param mixed $birth
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;
    }

    /**
     * @return mixed
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * @param mixed $resume
     */
    public function setResume($resume)
    {
        $this->resume = $resume;
    }

    /**
     * @return mixed
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param mixed $languages
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;
    }

    /**
     * @return mixed
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * @param mixed $jobs
     */
    public function setJobs($jobs)
    {
        $this->jobs = $jobs;
    }

    /**
     * @return mixed
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * @param mixed $courses
     */
    public function setCourses($courses)
    {
        $this->courses = $courses;
    }



    function __toString()
    {
        return $this->getId().'';
    }

    /**
     * @return mixed
     */
    public function getJobOffers()
    {
        return $this->jobOffers;
    }

    /**
     * @param mixed $jobOffers
     */
    public function setJobOffers($jobOffers)
    {
        $this->jobOffers = $jobOffers;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }


}