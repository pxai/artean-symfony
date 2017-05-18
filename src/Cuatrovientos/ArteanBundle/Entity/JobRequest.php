<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity
 * @ORM\Table(name="tbsolicitudes")
 */
class JobRequest extends Entity
{


    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(name="fechasolicitud",type="string", length=255)
     */
    private $offerdate;


    /**
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="idempresa", referencedColumnName="id")
     */
    private $company;

    private $companyName;

    /**
     * @ORM\Column(name="att",type="string", length=255)
     */
    private $att = "Att";

    /**
     * @ORM\Column(name="saludo",type="string", length=255)
     */
    private $greeting = "Estimado/a";

    /**
     * @ORM\Column(name="descripcionempresa",type="string", length=1000)
     */
    private $description;

    /**
     * @ORM\Column(name="provincia",type="string", length=255)
     */
    private $province = "Navarra";

    /**
     * @ORM\Column(name="poblacion",type="string", length=255)
     */
    private $city = "Pamplona";

    /**
     * @ORM\Column(name="sexo",type="string", length=20)
     */
    private $sex = "2";

    /**
     * @ORM\Column(name="horario",type="string", length=100)
     */
    private $schedule = "Sin especificar";

    /**
     * @ORM\Column(name="contrato",type="string", length=255)
     */
    private $contractType = "Sin especificar";

    /**
     * @ORM\Column(name="categoria",type="integer")
     */
    private $category = "";

    /**
     * @ORM\Column(name="formacion",type="string", length=100)
     */
    private $requiredStudies;

     /**
     * @ORM\Column(name="perfil",type="string", length=255)
     */
    private $profile;

    /**
     * @ORM\Column(name="requisitos",type="string", length=1000)
     */
    private $skills;

    /**
     * @ORM\Column(name="idiomas",type="string", length=255)
     */
    private $requiredLanguages;

     /**
     * @ORM\Column(name="vacantes",type="integer")
     */
    private $positionNo = 1;
    
     /**
     * @ORM\Column(name="jornada",type="string", length=255)
     */
    private $workday;

    /**
     * @ORM\Column(name="salario",type="string", length=255)
     */
    private $salary;

    /**
     * @ORM\Column(name="urgencia",type="integer")
     */
    private $urgent = 0;

    /**
     * @ORM\Column(name="incidencias",type="string", length=100)
     */
    private $issues;

    /**
     * @ORM\Column(name="notas",type="string", length=1000)
     */
    private $notes;

    /**
     * @ORM\Column(name="valoracion",type="integer")
     */
    private $rating;

    /**
     * @ORM\Column(name="status",type="string", length=20)
     */
    private $status;

    /**
     * ORM\OneToMany(targetEntity="JobRequestPreselected", mappedBy="applicant",fetch="EXTRA_LAZY", cascade={"all"})
     */
    /**
     * Many Companies have many degrees
     * @ORM\ManyToMany(targetEntity="Applicant", cascade={"all"})
     * @ORM\JoinTable(name="tbsolicitudes_alpre",
     *      joinColumns={@ORM\JoinColumn(name="idoffer", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="idapplicant", referencedColumnName="id")}
     *      )
     */
    private $preselectedApplicants;

    /**
     * Many Companies have many degrees
     * @ORM\ManyToMany(targetEntity="Applicant", cascade={"all"})
     * @ORM\JoinTable(name="tbsolicitudes_alsel",
     *      joinColumns={@ORM\JoinColumn(name="idoffer", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="idapplicant", referencedColumnName="id")}
     *      )
     */
    private $selectedApplicants;
       
    public function __construct () {
        //$this->selectedApplicants = array();
        //$this->preselectedApplicants = array();
       $this->status = "INICIO";
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
    public function getOfferdate()
    {
        return $this->offerdate;
    }

    /**
     * @param mixed $offerdate
     */
    public function setOfferdate($offerdate)
    {
        $this->offerdate = $offerdate;
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
    public function getAtt()
    {
        return $this->att;
    }

    /**
     * @param mixed $att
     */
    public function setAtt($att)
    {
        $this->att = $att;
    }

    /**
     * @return mixed
     */
    public function getGreeting()
    {
        return $this->greeting;
    }

    /**
     * @param mixed $greeting
     */
    public function setGreeting($greeting)
    {
        $this->greeting = $greeting;
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
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param mixed $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    /**
     * @return mixed
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * @param mixed $schedule
     */
    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * @return ContractType
     */
    public function getContractType()
    {
        return $this->contractType;
    }

    /**
     * @param ContractType $contract_type
     */
    public function setContractType($contractType)
    {
        $this->contractType = $contractType;
    }

    /**
     * @return mixed
     */
    public function getRequiredStudies()
    {
        return $this->requiredStudies;
    }

    /**
     * @param mixed $required_studies
     */
    public function setRequiredStudies($requiredStudies)
    {
        $this->requiredStudies = $requiredStudies;
    }

    /**
     * @return mixed
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param mixed $profile
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param mixed $skills
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    /**
     * @return mixed
     */
    public function getRequiredLanguages()
    {
        return $this->requiredLanguages;
    }

    /**
     * @param mixed $required_languages
     */
    public function setRequiredLanguages($requiredLanguages)
    {
        $this->requiredLanguages = $requiredLanguages;
    }

    /**
     * @return mixed
     */
    public function getPositionNo()
    {
        return $this->positionNo;
    }

    /**
     * @param mixed $position_no
     */
    public function setPositionNo($positionNo)
    {
        $this->positionNo = $positionNo;
    }

    /**
     * @return mixed
     */
    public function getWorkday()
    {
        return $this->workday;
    }

    /**
     * @param mixed $workday
     */
    public function setWorkday($workday)
    {
        $this->workday = $workday;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param mixed $salary
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    /**
     * @return mixed
     */
    public function getUrgent()
    {
        return $this->urgent;
    }

    /**
     * @param mixed $urgent
     */
    public function setUrgent($urgent)
    {
        $this->urgent = $urgent;
    }

    /**
     * @return mixed
     */
    public function getIssues()
    {
        return $this->issues;
    }

    /**
     * @param mixed $issues
     */
    public function setIssues($issues)
    {
        $this->issues = $issues;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    /**
     * @return mixed
     */
    public function getPreselectedApplicants()
    {
        return $this->preselectedApplicants;
    }

    /**
     * @param mixed $preselectedApplicants
     */
    public function setPreselectedApplicants($preselectedApplicants)
    {
        $this->preselectedApplicants = $preselectedApplicants;
    }

    /**
     * @return mixed
     */
    public function getSelectedApplicants()
    {
        return $this->selectedApplicants;
    }

    /**
     * @return mixed
     */
    public function addSelected($applicant)
    {
        $this->selectedApplicants[] = $applicant;
    }

    /**
     * @param mixed $selectedApplicants
     */
    public function setSelectedApplicants($selectedApplicants)
    {
        $this->selectedApplicants = $selectedApplicants;
    }



    
}