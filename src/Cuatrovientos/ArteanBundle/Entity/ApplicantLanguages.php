<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbalumnosidiomas")
 */
class ApplicantLanguages extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Applicant",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="idapplicant", referencedColumnName="id")
     */
    private $applicant;
  
    /**
     * @ORM\ManyToOne(targetEntity="Language",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="idlanguage", referencedColumnName="Codidioma")
     */
    private $language;


    /**
     * @ORM\ManyToOne(targetEntity="LanguageLevel",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="hablado", referencedColumnName="id")
     */
    private $speaking;

    /**
     * @ORM\ManyToOne(targetEntity="LanguageLevel",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="escrito", referencedColumnName="id")
     */
    private $writing;

    /**
     * @ORM\Column(name="notas",type="string", length=100)
     */
    private $description;

    public function __construct () {
        //$this->applicant = new Applicant();
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
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getSpeaking()
    {
        return $this->speaking;
    }

    /**
     * @param mixed $speaking
     */
    public function setSpeaking($speaking)
    {
        $this->speaking = $speaking;
    }

    /**
     * @return mixed
     */
    public function getWriting()
    {
        return $this->writing;
    }

    /**
     * @param mixed $writing
     */
    public function setWriting($writing)
    {
        $this->writing = $writing;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }



}