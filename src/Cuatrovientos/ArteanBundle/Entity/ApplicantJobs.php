<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbalumnoslaboral")
 */
class ApplicantJobs extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Applicant")
     * @ORM\JoinColumn(name="idapplicant", referencedColumnName="id")
     */
    private $applicant;

    /**
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="idemployer", referencedColumnName="id")
     */
    private $company;

    /**
     * @ORM\Column(name="company",type="string", length=100)
     */
    private $companyName;

    /**
     * @ORM\Column(name="tipocontrato",type="string", length=100)
     */
    private $contractType;

    /**
     * @ORM\Column(name="fechafin",type="string", length=100)
     */
    private $endDate;


    /**
     * @ORM\Column(name="descripcion",type="string", length=100)
     */
    private $description;




    public function __construct () {
        //$this->applicant = new Applicant();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
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
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
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
    public function getContractType()
    {
        return $this->contractType;
    }

    /**
     * @param mixed $contractType
     */
    public function setContractType($contractType)
    {
        $this->contractType = $contractType;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
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




}