<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\OfferRepository")
 * @ORM\Table(name="ofertas")
 */
class OfferOpen
{
  /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(name="empresa",type="string", length=100)
     */
    private $company;

    /**
     * @ORM\Column(name="offerdate",type="datetime", length=255)
     */
    private $offerdate;

    
     /**
     * @ORM\Column(name="puesto",type="string", length=255)
     */
    private $position;

     /**
     * @ORM\Column(name="vacantes",type="integer")
     */
    private $position_no;
    
     /**
     * @ORM\Column(name="descripcionoferta",type="string", length=255)
     */
    private $description;
    
    /**
     * @ORM\Column(name="estudiosrequeridos",type="array", length=50)
     */
    private $required_studies;

    /**
     * @ORM\Column(name="requisitos",type="array", length=255)
     */
    private $other_knowledges;
    
    /**
     * @ORM\Column(name="idiomas",type="array", length=255)
     */
    private $required_languages;


     /**
  * @var ContractType
  * @ORM\ManyToOne(targetEntity="ContractType")
  * @ORM\JoinColumn(name="tipocontrato", referencedColumnName="id")
  */
    private $contract_type;

     /**
     * @ORM\Column(name="salario",type="string", length=50)
     */
    private $salary;
    
     /**
     * @ORM\Column(name="jornada",type="string", length=50)
     */
    private $workday;
    
    /**
     * @ORM\Column(name="observaciones",type="string", length=255)
     */
    private $observations;
    
    /**
     * @ORM\Column(name="contacto",type="string", length=255)
     */
    private $contact;

        
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
  
    
    public function getCompany() {
        return $this->company;
    }

    public function getPosition() {
        return $this->position;
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

    public function getRequiredStudies() {
        return $this->required_studies;
    }

    public function getRequiredLanguages() {
        return $this->required_languages;
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

    public function setCompany($company) {
        $this->company = $company;
    }

    public function setPosition($position) {
        $this->position = $position;
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
   
        public function getContractType() {
        return $this->contract_type;
    }

    public function setContractType($contract_type) {
        $this->contract_type = $contract_type;
    }
    public function getOfferdate() {
        return $this->offerdate;
    }


    public function getSalary() {
        return $this->salary;
    }

    public function setOfferdate($offerdate) {
        $this->offerdate = $offerdate;
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }


    
}