<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbalumnoscursos")
 */
class StudentCourse extends Entity
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="dni",type="string", length=50)
     */
    private $dni;

    /**
     * @ORM\ManyToOne(targetEntity="Applicant")
     * @ORM\JoinColumn(name="idalumno", referencedColumnName="id")
     */
    private $applicant;

    private $applicantName;

    /**
     * @ORM\ManyToOne(targetEntity="Course")
     * @ORM\JoinColumn(name="codcursillo", referencedColumnName="id")
     */
    private $course;


    /**
     * @ORM\Column(name="n_alum",type="string", length=50)
     */
    private $studentNumber;

    /**
     * @ORM\Column(name="oficina_empleo",type="string", length=50)
     */
    private $employmentOffice;

    /**
     * @ORM\Column(name="cobra",type="string", length=50)
     */
    private $getsPaid;

    /**
     * @ORM\Column(name="fecha_alta",type="datetime")
     */
    private $signUpDate;

    /**
     * @ORM\Column(name="fecha_baja",type="datetime")
     */
    private $dropInDate;

    /**
     * @ORM\Column(name="baja",type="string", length=14)
     */
    private $dropIn;

    /**
     * @ORM\Column(name="finaliza_curso",type="string", length=14)
     */
    private $endsCourse;

    /**
     * @ORM\Column(name="resultado_baja",type="string", length=50)
     */
    private $dropInResult;

    /**
     * @ORM\Column(name="beca",type="string", length=12)
     */
    private $grant;

    /**
     * @ORM\Column(name="evaluacion",type="string", length=50)
     */
    private $assessment;

    /**
     * @ORM\Column(name="observaciones",type="string")
     */
    private $observations;

    /**
     * @ORM\Column(name="ingreso",type="string", length=100)
     */
    private $deposit;

    /**
     * @ORM\Column(name="ingreso_pendiente",type="string", length=50)
     */
    private $pendingDeposit;

    /**
     * @ORM\Column(name="cargar_recibo",type="string", length=50)
     */
    private $chargeInvoice;

    /**
     * @ORM\Column(name="importe_recibo",type="string", length=50)
     */
    private $invoiceAmount;

    /**
     * @ORM\Column(name="ingreso_pzo_2",type="string", length=50)
     */
    private $secondInvoice;


    /**
     * @ORM\Column(name="dias_recuento_final_seg",type="string", length=20)
     */
    private $recountingDays;

    /**
     * @ORM\Column(name="asegurar",type="string", length=50)
     */
    private $insurance;

    /**
     * @ORM\Column(name="dias_seguro",type="string", length=50)
     */
    private $insuranceDays;

    /**
     * @ORM\Column(name="turnos_",type="string", length=50)
     */
    private $turns;

    public function __construct () {
        $this->signUpDate = new \DateTime("now");
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
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
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
    public function getStudentNumber()
    {
        return $this->studentNumber;
    }

    /**
     * @param mixed $studentNumber
     */
    public function setStudentNumber($studentNumber)
    {
        $this->studentNumber = $studentNumber;
    }

    /**
     * @return mixed
     */
    public function getEmploymentOffice()
    {
        return $this->employmentOffice;
    }

    /**
     * @param mixed $employmentOffice
     */
    public function setEmploymentOffice($employmentOffice)
    {
        $this->employmentOffice = $employmentOffice;
    }

    /**
     * @return mixed
     */
    public function getGetsPaid()
    {
        return $this->getsPaid;
    }

    /**
     * @param mixed $getsPaid
     */
    public function setGetsPaid($getsPaid)
    {
        $this->getsPaid = $getsPaid;
    }

    /**
     * @return mixed
     */
    public function getSignUpDate()
    {
        return $this->signUpDate;
    }

    /**
     * @param mixed $signUpDate
     */
    public function setSignUpDate($signUpDate)
    {
        $this->signUpDate = $signUpDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDropInDate()
    {
        return $this->dropInDate;
    }

    /**
     * @param mixed $dropInDate
     */
    public function setDropInDate($dropInDate)
    {
        $this->signUpDate = $dropInDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDropIn()
    {
        return $this->dropIn;
    }

    /**
     * @param mixed $dropIn
     */
    public function setDropIn($dropIn)
    {
        $this->dropIn = $dropIn;
    }

    /**
     * @return mixed
     */
    public function getEndsCourse()
    {
        return $this->endsCourse;
    }

    /**
     * @param mixed $endsCourse
     */
    public function setEndsCourse($endsCourse)
    {
        $this->endsCourse = $endsCourse;
    }

    /**
     * @return mixed
     */
    public function getDropInResult()
    {
        return $this->dropInResult;
    }

    /**
     * @param mixed $dropInResult
     */
    public function setDropInResult($dropInResult)
    {
        $this->dropInResult = $dropInResult;
    }

    /**
     * @return mixed
     */
    public function getGrant()
    {
        return $this->grant;
    }

    /**
     * @param mixed $grant
     */
    public function setGrant($grant)
    {
        $this->grant = $grant;
    }

    /**
     * @return mixed
     */
    public function getAssessment()
    {
        return $this->assessment;
    }

    /**
     * @param mixed $assessment
     */
    public function setAssessment($assessment)
    {
        $this->assessment = $assessment;
    }

    /**
     * @return mixed
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * @param mixed $observations
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;
    }

    /**
     * @return mixed
     */
    public function getDeposit()
    {
        return $this->deposit;
    }

    /**
     * @param mixed $deposit
     */
    public function setDeposit($deposit)
    {
        $this->deposit = $deposit;
    }

    /**
     * @return mixed
     */
    public function getPendingDeposit()
    {
        return $this->pendingDeposit;
    }

    /**
     * @param mixed $pendingDeposit
     */
    public function setPendingDeposit($pendingDeposit)
    {
        $this->pendingDeposit = $pendingDeposit;
    }

    /**
     * @return mixed
     */
    public function getChargeInvoice()
    {
        return $this->chargeInvoice;
    }

    /**
     * @param mixed $chargeInvoice
     */
    public function setChargeInvoice($chargeInvoice)
    {
        $this->chargeInvoice = $chargeInvoice;
    }

    /**
     * @return mixed
     */
    public function getInvoiceAmount()
    {
        return $this->invoiceAmount;
    }

    /**
     * @param mixed $invoiceAmount
     */
    public function setInvoiceAmount($invoiceAmount)
    {
        $this->invoiceAmount = $invoiceAmount;
    }

    /**
     * @return mixed
     */
    public function getSecondInvoice()
    {
        return $this->secondInvoice;
    }

    /**
     * @param mixed $secondInvoice
     */
    public function setSecondInvoice($secondInvoice)
    {
        $this->secondInvoice = $secondInvoice;
    }

    /**
     * @return mixed
     */
    public function getRecountingDays()
    {
        return $this->recountingDays;
    }

    /**
     * @param mixed $recountingDays
     */
    public function setRecountingDays($recountingDays)
    {
        $this->recountingDays = $recountingDays;
    }

    /**
     * @return mixed
     */
    public function getInsurance()
    {
        return $this->insurance;
    }

    /**
     * @param mixed $insurance
     */
    public function setInsurance($insurance)
    {
        $this->insurance = $insurance;
    }

    /**
     * @return mixed
     */
    public function getInsuranceDays()
    {
        return $this->insuranceDays;
    }

    /**
     * @param mixed $insuranceDays
     */
    public function setInsuranceDays($insuranceDays)
    {
        $this->insuranceDays = $insuranceDays;
    }

    /**
     * @return mixed
     */
    public function getTurns()
    {
        return $this->turns;
    }

    /**
     * @param mixed $turns
     */
    public function setTurns($turns)
    {
        $this->turns = $turns;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
    }


}