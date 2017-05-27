<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbmailing_destinatario")
 */
class MailingSelectedApplicant extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Applicant")
     * @ORM\JoinColumn(name="idcandidato", referencedColumnName="id")
     */
    private $applicant;

    /**
     * @ORM\ManyToOne(targetEntity="Mailing")
     * @ORM\JoinColumn(name="idmailing", referencedColumnName="id")
     */
    private $mailing;



    public function __construct () {
        $this->applicant = new Applicant();
        $this->mailing = new Mailing();
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
    public function getMailing()
    {
        return $this->mailing;
    }

    /**
     * @param mixed $mailing
     */
    public function setMailing($mailing)
    {
        $this->mailing = $mailing;
    }



   
}