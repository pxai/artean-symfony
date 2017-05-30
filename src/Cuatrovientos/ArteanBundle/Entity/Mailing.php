<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbmailing")
 */
class Mailing extends Entity
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
     * @ORM\Column(name="mailfrom",type="string", length=100)
     */
    private $mailFrom = "artean@cuatrovientos.org";

    /**s
     * @ORM\Column(name="mailto",type="string", length=100)
     */
    private $mailTo;

    /**
     * @ORM\Column(name="bcc",type="string", length=255)
     */
    private $bcc;

    /**
     * @ORM\Column(name="subject",type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\Column(name="body",type="string")
     */
    private $body;

    /**
     * @ORM\Column(name="maildate",type="string", length=50)
     */
    private $mailDate;

    /**
     * @ORM\Column(name="type",type="integer", length=100)
     */
    private $type;

    /**
     * Many Companies have many degrees
     * @ORM\ManyToMany(targetEntity="Applicant", indexBy="id", cascade={"all"})
     * @ORM\JoinTable(name="tbmailing_destinatario",
     *      joinColumns={@ORM\JoinColumn(name="idmailing", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="idcandidato", referencedColumnName="id")}
     *      )
     */
    private $selectedApplicants;

    /**
     * Many Companies have many degrees
     * @ORM\ManyToMany(targetEntity="Company", indexBy="id",cascade={"all"})
     * @ORM\JoinTable(name="tbmailing_empresa_destinataria",
     *      joinColumns={@ORM\JoinColumn(name="idmailing", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="idempresa", referencedColumnName="id")}
     *      )
     */
    private $selectedCompanies;

    /**
     * @ORM\OneToMany(targetEntity="MailingSelectedApplicant", mappedBy="mailing",fetch="EXTRA_LAZY")
     */
    private $mailingSelectedApplicants;

    /**
     * @ORM\OneToMany(targetEntity="MailingSelectedCompany", mappedBy="mailing",fetch="EXTRA_LAZY")
     */
    private $mailingSelectedCompanies;

    public function __construct () {
        $this->selectedCompanies = new ArrayCollection();
        $this->selectedApplicants =  new ArrayCollection();
        $this->mailingSelectedApplicants =  new ArrayCollection();
        $this->mailingSelectedCompanies =  new ArrayCollection();
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
    public function getMailTo()
    {
        return $this->mailTo;
    }

    /**
     * @param mixed $mailTo
     */
    public function setMailTo($mailTo)
    {
        $this->mailTo = $mailTo;
    }

    /**
     * @return mixed
     */
    public function getMailFrom()
    {
        return $this->mailFrom;
    }

    /**
     * @param mixed $mailFrom
     */
    public function setMailFrom($mailFrom)
    {
        $this->mailFrom = $mailFrom;
    }

    /**
     * @return mixed
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @param mixed $bcc
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getMailDate()
    {
        return $this->mailDate;
    }

    /**
     * @param mixed $mailDate
     */
    public function setMailDate($mailDate)
    {
        $this->mailDate = $mailDate;
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
    public function getSelectedApplicants()
    {
        return $this->selectedApplicants;
    }

    /**
     * @param mixed $selectedApplicants
     */
    public function setSelectedApplicants($selectedApplicants)
    {
        foreach($this->selectedApplicants as $id => $applicant) {
            if(isset($selectedApplicants[$id])) {
                unset($selectedApplicants[$id]);
            }
        }

        //add products that exist in new but not in old
        foreach($selectedApplicants as $id => $applicant) {
            $this->selectedApplicants[$id] = $applicant;
        }
       // $this->selectedApplicants = $selectedApplicants;
    }

    /**
     * @return mixed
     */
    public function getSelectedCompanies()
    {
        return $this->selectedCompanies;
    }

    /**
     * @param mixed $selectedCompanies
     */
    public function setSelectedCompanies($selectedCompanies)
    {
        foreach($this->selectedCompanies as $id => $company) {
            if(isset($selectedCompanies[$id])) {
                unset($selectedCompanies[$id]);
            }
        }

        //add products that exist in new but not in old
        foreach($selectedCompanies as $id => $company) {
            $this->selectedCompanies[$id] = $company;
        }

    }

    /**
     * @return mixed
     */
    public function getMailingSelectedApplicants()
    {
        return $this->mailingSelectedApplicants;
    }

    /**
     * @param mixed $mailingSelected
     */
    public function setMailingSelectedApplicants($mailingSelectedApplicants)
    {
        $this->mailingSelectedApplicants = $mailingSelectedApplicants;
    }

    /**
     * @return mixed
     */
    public function getMailingSelectedCompanies()
    {
        return $this->mailingSelectedCompanies;
    }

    /**
     * @param mixed $mailingSelectedCompanies
     */
    public function setMailingSelectedCompanies($mailingSelectedCompanies)
    {
        $this->mailingSelectedCompanies = $mailingSelectedCompanies;
    }


    function __toString()
    {
        return $this->getSubject();
    }
}