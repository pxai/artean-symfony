<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbmailattachment")
 */
class MailingAttachment extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name",type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="path",type="string", length=255)
     */
    private $path;

    /**
     * @ORM\ManyToOne(targetEntity="Mailing")
     * @ORM\JoinColumn(name="idmailing", referencedColumnName="id")
     */
    private $mailing;


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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
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