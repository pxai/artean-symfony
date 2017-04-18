<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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


    function __toString()
    {
        return $this->getSubject();
    }
}