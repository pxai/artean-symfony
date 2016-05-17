<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\OfferRepository")
 * @ORM\Table(name="tboffer")
 */
class OfferOpen
{
  /**
     * @ORM\Column(name="codcentro",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\Column(name="company",type="string", length=50)
     */
    private $company;
  
     /**
     * @ORM\Column(name="position",type="string", length=50)
     */
    private $position;
  
         /**
     * @ORM\Column(name="functions",type="string", length=50)
     */
    private $functions;
    
         /**
     * @ORM\Column(name="position_no",type="string", length=50)
     */
    private $position_no;

     /**
     * @ORM\Column(name="contract_type",type="string", length=50)
     */
    private $contract_type;
    
     /**
     * @ORM\Column(name="workday",type="string", length=50)
     */
    private $workday;

    /**
     * @ORM\Column(name="required_studies",type="string", length=50)
     */
    private $required_studies;
    
    /**
     * @ORM\Column(name="required_languages",type="string", length=50)
     */
    private $required_languages;

    /**
     * @ORM\Column(name="other_knowledges",type="array", length=50)
     */
    private $other_knowledges;
    
    /**
     * @ORM\Column(name="observations",type="string", length=50)
     */
    private $observations;
    
    /**
     * @ORM\Column(name="contact",type="string", length=50)
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

    public function getFunctions() {
        return $this->functions;
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

    public function setFunctions($functions) {
        $this->functions = $functions;
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
}