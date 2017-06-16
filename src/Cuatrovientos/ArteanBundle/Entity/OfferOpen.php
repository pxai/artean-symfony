<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * SOLICITUD BOLSA DE EMPLEO
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\OfferOpenRepository")
 * @ORM\Table(name="ofertas")
 */
class OfferOpen extends Entity
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
     * @ORM\Column(name="direccion",type="string", length=100)
     */
    private $address;

    /**
     * @ORM\Column(name="localidad",type="string", length=100)
     */
    private $city;

    /**
     * @ORM\Column(name="actividad",type="string", length=255)
     */
    private $activity;

    /**
     * @ORM\Column(name="persona_contacto",type="string", length=100)
     */
    private $contactPerson;

    /**
     * @ORM\Column(name="email_contacto",type="string", length=100)
     */
    private $contactEmail;

    /**
     * @ORM\Column(name="telefono_contacto",type="string", length=100)
     */
    private $contactPhone;

    /**
     * @ORM\Column(name="fechaoferta",type="datetime", length=255)
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
     * @ORM\Column(name="estudiosrequeridos",type="array", length=50, nullable=TRUE)
     */
    private $required_studies;

    /**
     * @ORM\Column(name="requisitos",type="string", length=255)
     */
    private $other_knowledges;
    
    /**
     * @ORM\Column(name="idiomas",type="array", length=255, nullable=TRUE)
     */
    private $required_languages;


  /**
  * @var ContractType
  * @ORM\ManyToOne(targetEntity="ContractType")
  * @ORM\JoinColumn(name="tipocontrato", referencedColumnName="id")
  */
    private $contract_type;

    /**
     * @ORM\Column(name="contrato",type="string", length=255)
     */
    private $contract;

     /**
     * @ORM\Column(name="salario",type="string", length=50)
     */
    private $salary;
    
     /**
     * @ORM\Column(name="jornada",type="string", length=50)
     */
    private $workday;

     /**
     * @ORM\Column(name="horario",type="string", length=50)
     */
    private $schedule;

    /**
     * @ORM\Column(name="observaciones",type="string", length=255)
     */
    private $observations;
    
    /**
     * @ORM\Column(name="contacto",type="string", length=255)
     */
    private $contact;
    
    /**
     * @ORM\Column(name="publicada",type="integer")
     */
    private $published = 0;

    /**
     * @ORM\Column(name="tipo",type="integer")
     */
    private $type = 1;



    /**
     * @ORM\Column(name="notificada",type="integer")
     */
    private $notified = 0;

    public function __construct () {
        $this->required_languages = array();
        $this->required_studies = array();
        $this->published = 0;
    }

  
    public function getId() {
        return $this->id;
    }

    public function getCompany() {
        return $this->company;
    }

    public function getOfferdate() {
        return $this->offerdate;
    }

    public function getPosition() {
        return $this->position;
    }

    public function getPositionNo() {
        return $this->position_no;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getRequiredStudies() {
        return $this->required_studies;
    }

    public function getRequiredLanguagesString() {
        $result = '';
        foreach($this->required_languages as $s) {
            $result .= $s. ', ';
        }
        $result = rtrim($result,', ');
        return $result;
    }

    public function getRequiredStudiesString() {
        $result = '';
        foreach($this->required_studies as $s) {
            $result .= $s. ', ';
        }
        $result = rtrim($result,', ');
        return $result;
    }

    public function getOtherKnowledges() {
        return $this->other_knowledges;
    }

    public function getRequiredLanguages() {
        return $this->required_languages;
    }

    public function getContractType() {
        return $this->contract_type;
    }

    public function getSalary() {
        return $this->salary;
    }

    public function getWorkday() {
        return $this->workday;
    }

    public function getSchedule() {
        return $this->schedule;
    }

    public function getObservations() {
        return $this->observations;
    }

    public function getContact() {
        return $this->contact;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCompany($company) {
        $this->company = $company;
    }

    public function setOfferdate($offerdate) {
        $this->offerdate = $offerdate;
    }

    public function setPosition($position) {
        $this->position = $position;
    }

    public function setPositionNo($position_no) {
        $this->position_no = $position_no;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setRequiredStudies($required_studies) {
        $this->required_studies = $required_studies;
    }

    public function setOtherKnowledges($other_knowledges) {
        $this->other_knowledges = $other_knowledges;
    }

    public function setRequiredLanguages($required_languages) {
        $this->required_languages = $required_languages;
    }

    public function setContractType(ContractType $contract_type) {
        $this->contract_type = $contract_type;
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }

    public function setWorkday($workday) {
        $this->workday = $workday;
    }

    public function setSchedule($schedule) {
        $this->schedule = $schedule;
    }

    public function setObservations($observations) {
        $this->observations = $observations;
    }

    public function setContact($contact) {
        $this->contact = $contact;
    }

    public function getPublished() {
        return $this->published;
    }

    public function setPublished($published) {
        $this->published = $published;
    }

    /**
     * @return mixed
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * @param mixed $contract
     */
    public function setContract($contract)
    {
        $this->contract = $contract;
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
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * @param mixed $activity
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;
    }

    /**
     * @return mixed
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * @param mixed $contactPerson
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;
    }

    /**
     * @return mixed
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * @param mixed $contactEmail
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;
    }

    /**
     * @return mixed
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * @param mixed $contactPhone
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getNotified()
    {
        return $this->notified;
    }

    /**
     * @param mixed $notified
     */
    public function setNotified($notified)
    {
        $this->notified = $notified;
    }
    
}