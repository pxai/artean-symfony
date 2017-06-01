<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cuatrovientos\ArteanBundle\Entity\Center;
use Cuatrovientos\ArteanBundle\Entity\Studies;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbalumnosestudios")
 */
class ApplicantStudies extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Applicant",inversedBy="studies",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="idapplicant", referencedColumnName="id")
     */
    private $applicant;
  
    /**
     * @ORM\ManyToOne(targetEntity="Studies",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="codestudios", referencedColumnName="id")
     */
    private $studies;

    /**
     * @ORM\Column(name="descripcion",type="string", length=100)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Center",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="codcentro", referencedColumnName="codcentro")
     */
    private $center;

    private $studiesValue;
    private $centerValue;

    /**
     * @ORM\Column(name="anofin",type="integer")
     */
    private $endYear;


    public function __construct () {
    }

    public function getId() {
        return $this->id;
    }


    public function getDescription() {
        return $this->description;
    }


    public function setId($id) {
        $this->id = $id;
    }


    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getEndYear()
    {
        return $this->endYear;
    }

    /**
     * @param mixed $endYear
     */
    public function setEndYear($endYear)
    {
        $this->endYear = $endYear;
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
    public function getStudies()
    {
        return $this->studies;
    }

    /**
     * @param mixed $studies
     */
    public function setStudies($studies)
    {
        $this->studies = $studies;
    }

    /**
     * @return mixed
     */
    public function getCenter()
    {
        return $this->center;
    }

    /**
     * @param mixed $centerValue
     */
    public function setCenter($center)
    {
        $this->center = $center;
    }

    /**
     * @param mixed $center
     */
    public function setNewCenter()
    {
        $center = new Center();
        $center->setId($this->centerValue);
        $this->setCenter($center);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCenterValue()
    {
        return $this->centerValue;
    }

    /**
     * @param mixed $centerValue
     */
    public function setCenterValue($centerValue)
    {
        $this->centerValue = $centerValue;
    }

    /**
     * @return mixed
     */
    public function getStudiesValue()
    {
        return $this->studiesValue;
    }

    /**
     * @param mixed $center
     */
    public function setNewStudies()
    {
        $studies = new Studies();
        $studies->setId($this->studiesValue);
        $this->setStudies($studies);
        return $this;
    }
    /**
     * @param mixed $studiesValue
     */
    public function setStudiesValue($studiesValue)
    {
        $this->studiesValue = $studiesValue;
    }


   
}