<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbprofesorescursos")
 */
class TeacherCourse extends Entity
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Applicant")
     * @ORM\JoinColumn(name="idprofesor", referencedColumnName="id")
     */
    private $applicant;

    private $applicantName;

    /**
     * @ORM\ManyToOne(targetEntity="Course")
     * @ORM\JoinColumn(name="codcursillo", referencedColumnName="id")
     */
    private $course;


    /**
     * @ORM\Column(name="horas_",type="string", length=50)
     */
    private $hours;



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
     * @return mixed
     */
    public function getApplicant()
    {
        return $this->applicant;
    }

    /**
     * @param mixed $applicant
     */
    public function setApplicant($applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * @param mixed $company
     */
    public function setNewApplicant()
    {
        $applicant = new Applicant();
        $applicant->setId($this->applicantName);
        $this->setApplicant($applicant);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApplicantName()
    {
        return $this->applicantName;
    }

    /**
     * @param mixed $applicantName
     */
    public function setApplicantName($applicantName)
    {
        $this->applicantName = $applicantName;
    }


    /**
     * @return mixed
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param mixed $course
     */
    public function setCourse($course)
    {
        $this->course = $course;
    }

    /**
     * @return mixed
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * @param mixed $hours
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
    }


}