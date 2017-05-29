<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbmailing_empresa_destinataria")
 */
class MailingSelectedCompany extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="idempresa", referencedColumnName="id")
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity="Mailing")
     * @ORM\JoinColumn(name="idmailing", referencedColumnName="id")
     */
    private $mailing;

    /**
     * @ORM\Column(name="enviado",type="integer")
     */
    private $sent;

    public function __construct () {
        $this->company = new Company();
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
    public function getCompany()
    {
        return $this->company;
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

    /**
     * @return mixed
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * @param mixed $sent
     */
    public function setSent($sent)
    {
        $this->sent = $sent;
    }



   
}