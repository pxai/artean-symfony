<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\OfferRepository")
 * @ORM\Table(name="ofertas")
 */
class OfferAdOpen
{
  /**
     * @ORM\Column(name="codcentro",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    private $company;
  
     /**
     * @ORM\Column(name="puesto",type="string", length=255)
     */
    private $position;
  
    private $location;
    
     /**
     * @ORM\Column(name="descripcionoferta",type="string", length=255)
     */
    private $description;
    
         /**
     * @ORM\Column(name="vacantes",type="integer")
     */
    private $position_no;

     /**
  * @var ContractType
  * @ORM\ManyToOne(targetEntity="ContractType")
  * @ORM\JoinColumn(name="tipocontrato", referencedColumnName="id")
  */
    private $contract_type;
    
     /**
     * @ORM\Column(name="jornada",type="string", length=50)
     */
    private $workday;

    /**
     * @ORM\Column(name="estudiosrequeridos",type="array", length=50)
     */
    private $required_studies;
    
    /**
     * @ORM\Column(name="idiomas",type="array", length=50, nullable=TRUE)
     */
    private $required_languages;

    /**
     * @ORM\Column(name="requisitos",type="string", length=255)
     */
    private $other_knowledges;
    
    /**
     * @ORM\Column(name="observaciones",type="string", length=50)
     */
    private $observations;
 
    private $cv_date;
        
    private $contact;

        
    public function __construct () {
        $this->required_languages = array();
        $this->required_studies = array();
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
  
    
    public function getCompany() {
        return $this->company;
    }

    public function getPosition() {
        return $this->position;
    }
    
    public function getLocation() {
        return $this->location;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPositionNo() {
        return $this->position_no;
    }

    public function getWorkday() {
        return $this->workday;
    }
    
    public function getContractType() {
        return $this->contract_type;
    }
    
    public function getRequiredStudies() {
        return $this->required_studies;
    }

    public function getRequiredStudiesString() {
        $result = '';
        foreach($this->required_studies as $s) {
            $result .= $s. ', ';
        }
        $result = rtrim($result,', ');
        return $result;
    }

    public function getRequiredLanguages() {
        return $this->required_languages;
    }

    public function getRequiredLanguagesString() {
        $result = '';
        foreach($this->required_languages as $s) {
            $result .= $s. ', ';
        }
        $result = rtrim($result,', ');
        return $result;
    }

    public function getOtherKnowledges() {
        return $this->other_knowledges;
    }

    public function getObservations() {
        return $this->observations;
    }

    public function getContact() {
        return $this->contact;
    }

    public function getCvDate() {
        return $this->cv_date;
    }
    
    public function setCompany($company) {
        $this->company = $company;
    }

    public function setPosition($position) {
        $this->position = $position;
    }
    
    public function setLocation($location) {
        $this->location = $location;
    }

    public function setDescription ($description) {
        $this->description = $description;
    }

    public function setPositionNo($position_no) {
        $this->position_no = $position_no;
    }

    public function setWorkday($workday) {
        $this->workday = $workday;
    }

    public function setRequiredStudies($required_studies) {
        $this->required_studies = $required_studies;
    }

    public function setRequiredLanguages($required_languages) {
        $this->required_languages = $required_languages;
    }

    public function setOtherKnowledges($other_knowledges) {
        $this->other_knowledges = $other_knowledges;
    }

    public function setObservations($observations) {
        $this->observations = $observations;
    }

    public function setContact($contact) {
        $this->contact = $contact;
    }
   
    public function setCvDate($cv_date) {
        $this->cv_date = $cv_date;
    }

    public function setContractType($contract_type) {
        $this->contract_type = $contract_type;
    }
}