<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbsolicitudes_alsel")
 */
class JobRequestSelected extends Entity
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
     * @ORM\ManyToOne(targetEntity="JobRequest")
     * @ORM\JoinColumn(name="idoffer", referencedColumnName="id")
     */
    private $jobRequest;



    public function __construct () {
        $this->applicant = new Applicant();
        $this->jobRequest = new JobRequest();
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
    public function getJobRequest()
    {
        return $this->jobRequest;
    }

    /**
     * @param mixed $jobRequest
     */
    public function setJobRequest($jobRequest)
    {
        $this->jobRequest = $jobRequest;
    }


   
}