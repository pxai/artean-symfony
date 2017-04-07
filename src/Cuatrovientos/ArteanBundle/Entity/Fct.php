<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\FctRepository")
 * @ORM\Table(name="ofertas")
 */
class Fct extends Entity
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Company
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="idempresa", referencedColumnName="id")
     */
    private $company;

    /**
     * @var Applicant
     * @ORM\ManyToOne(targetEntity="Applicant")
     * @ORM\JoinColumn(name="idalumno", referencedColumnName="id")
     */
    private $applicant;

    /**
     * @ORM\Column(name="curso",type="string", length=10)
     */
    private $curso;

    /**
     * @ORM\Column(name="period",type="string", length=255)
     */
    private $period;

    /**
     * var Degree
     * ORM\ManyToOne(targetEntity="Degree")
     * ORM\JoinColumn(name="idciclo", referencedColumnName="id")
     */

    /**
     * @ORM\Column(name="idciclo",type="integer", length=255)
     */
    private $degree;

    /**
     * @ORM\Column(name="tutor_empresa",type="string", length=255)
     */
    private $company_tutor;

    /**
     * @ORM\Column(name="contacto_empresa",type="string", length=255)
     */
    private $company_contact;

    /**
 * var Applicant
 * ORM\ManyToOne(targetEntity="Applicant")
 * ORM\JoinColumn(name="idapplicant", referencedColumnName="id")
 */
    /**
     * @ORM\Column(name="idapplicant",type="integer", length=255)
     */
    private $school_tutor;

    /**
     * @ORM\Column(name="fecha",type="datetime", length=255)
     */
    private $fct_date;

    /**
     * @ORM\Column(name="descripcion",type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(name="resultados",type="string", length=50)
     */
    private $resultados;

    /**
     * @ORM\Column(name="valoracion_alumno",type="string", length=500)
     */
    private $applicant_rating;

    /**
     * @ORM\Column(name="valoracion_cuatrovientos",type="string", length=500)
     */
    private $school_rating;

    /**
     * @ORM\Column(name="valoracion_empresa",type="string", length=500)
     */
    private $company_rating;


    public function __construct()
    {
        //$this->required_languages = array();
        //$this->required_studies = array();
        $this->fct_date = new \DateTime();
    }

    /**
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Company $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return Applicant
     */
    public function getApplicant()
    {
        return $this->applicant;
    }

    /**
     * @param Applicant $applicant
     */
    public function setApplicant($applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * @return mixed
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * @param mixed $curso
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;
    }

    /**
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param mixed $period
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    }

    /**
     * @return Degree
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * @param Degree $degree
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;
    }

    /**
     * @return mixed
     */
    public function getCompanyTutor()
    {
        return $this->company_tutor;
    }

    /**
     * @param mixed $company_tutor
     */
    public function setCompanyTutor($company_tutor)
    {
        $this->company_tutor = $company_tutor;
    }

    /**
     * @return mixed
     */
    public function getCompanyContact()
    {
        return $this->company_contact;
    }

    /**
     * @param mixed $company_contact
     */
    public function setCompanyContact($company_contact)
    {
        $this->company_contact = $company_contact;
    }

    /**
     * @return Applicant
     */
    public function getSchoolTutor()
    {
        return $this->school_tutor;
    }

    /**
     * @param Applicant $school_tutor
     */
    public function setSchoolTutor($school_tutor)
    {
        $this->school_tutor = $school_tutor;
    }

    /**
     * @return mixed
     */
    public function getFctDate()
    {
        return $this->fct_date;
    }

    /**
     * @param mixed $fct_date
     */
    public function setFctDate($fct_date)
    {
        $this->fct_date = $fct_date;
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
     * @return mixed
     */
    public function getResultados()
    {
        return $this->resultados;
    }

    /**
     * @param mixed $resultados
     */
    public function setResultados($resultados)
    {
        $this->resultados = $resultados;
    }

    /**
     * @return mixed
     */
    public function getApplicantRating()
    {
        return $this->applicant_rating;
    }

    /**
     * @param mixed $applicant_rating
     */
    public function setApplicantRating($applicant_rating)
    {
        $this->applicant_rating = $applicant_rating;
    }

    /**
     * @return mixed
     */
    public function getSchoolRating()
    {
        return $this->school_rating;
    }

    /**
     * @param mixed $school_rating
     */
    public function setSchoolRating($school_rating)
    {
        $this->school_rating = $school_rating;
    }

    /**
     * @return mixed
     */
    public function getCompanyRating()
    {
        return $this->company_rating;
    }

    /**
     * @param mixed $company_rating
     */
    public function setCompanyRating($company_rating)
    {
        $this->company_rating = $company_rating;
    }


}