<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbfct")
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

    private $companyName;

    /**
     * @var Applicant
     * @ORM\ManyToOne(targetEntity="Applicant")
     * @ORM\JoinColumn(name="idalumno", referencedColumnName="id")
     */
    private $applicant;

    private $applicantName;

    /**
     * @ORM\Column(name="curso",type="string", length=10)
     */
    private $course = "2016-2017";

    /**
     * @ORM\Column(name="periodo",type="string", length=255)
     */
    private $period = "Marzo";

    /**
     * ORM\ManyToOne(targetEntity="Degree")
     * ORM\JoinColumn(name="idciclo", referencedColumnName="id")
     */
    private $degree;

    /**
     * @ORM\Column(name="tutor_empresa",type="string", length=255)
     */
    private $companyTutor = "Por determinar";

    /**
     * @ORM\Column(name="contacto_empresa",type="string", length=255)
     */
    private $companyContact = "Por determinar";

    /**
     * ORM\ManyToOne(targetEntity="User")
     * ORM\JoinColumn(name="tutor_instituto", referencedColumnName="id")
     */
    private $schoolTutor = "Por determinar";

    /**
     * @ORM\Column(name="fecha",type="date", length=255)
     */
    private $fctDate;

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
    private $applicantRating = "Sin valoración";

    /**
     * @ORM\Column(name="valoracion_cuatrovientos",type="string", length=500)
     */
    private $schoolRating = "Sin valoración";

    /**
     * @ORM\Column(name="valoracion_empresa",type="string", length=500)
     */
    private $companyRating = "Sin valoración";


    public function __construct()
    {
        //$this->required_languages = array();
        //$this->required_studies = array();
        $this->fctDate = new \DateTime();
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
     * @param mixed $company
     */
    public function setNewCompany()
    {
        $company = new Company();
        $company->setId($this->companyName);
        $this->setCompany($company);
        return $this;
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
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param mixed $curso
     */
    public function setCourse($course)
    {
        $this->course = $course;
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
        return $this->companyTutor;
    }

    /**
     * @param mixed $company_tutor
     */
    public function setCompanyTutor($companyTutor)
    {
        $this->companyTutor = $companyTutor;
    }

    /**
     * @return mixed
     */
    public function getCompanyContact()
    {
        return $this->companyContact;
    }

    /**
     * @param mixed $company_contact
     */
    public function setCompanyContact($companyContact)
    {
        $this->companyContact = $companyContact;
    }

    /**
     * @return Applicant
     */
    public function getSchoolTutor()
    {
        return $this->schoolTutor;
    }

    /**
     * @param Applicant $school_tutor
     */
    public function setSchoolTutor($schoolTutor)
    {
        $this->schoolTutor = $schoolTutor;
    }

    /**
     * @return mixed
     */
    public function getFctDate()
    {
        return $this->fctDate;
    }

    /**
     * @param mixed $fct_date
     */
    public function setFctDate($fctDate)
    {
        $this->fctDate = $fctDate;
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
        return $this->applicantRating;
    }

    /**
     * @param mixed $applicant_rating
     */
    public function setApplicantRating($applicantRating)
    {
        $this->applicantRating = $applicantRating;
    }

    /**
     * @return mixed
     */
    public function getSchoolRating()
    {
        return $this->schoolRating;
    }

    /**
     * @param mixed $school_rating
     */
    public function setSchoolRating($schoolRating)
    {
        $this->schoolRating = $schoolRating;
    }

    /**
     * @return mixed
     */
    public function getCompanyRating()
    {
        return $this->companyRating;
    }

    /**
     * @param mixed $company_rating
     */
    public function setCompanyRating($companyRating)
    {
        $this->companyRating = $companyRating;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
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


}