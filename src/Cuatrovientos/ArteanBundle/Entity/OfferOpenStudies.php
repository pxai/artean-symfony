<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cuatrovientos\ArteanBundle\Entity\Center;
use Cuatrovientos\ArteanBundle\Entity\Studies;

/**
 * @ORM\Entity
 * @ORM\Table(name="ofertasestudios")
 */
class OfferOpenStudies extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="OfferOpen")
     * @ORM\JoinColumn(name="idoffer", referencedColumnName="id")
     */
    private $offer;

    /**
     * @ORM\ManyToOne(targetEntity="Degree",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="codestudios", referencedColumnName="id")
     */
    private $studies;

    public function __construct () {
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
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * @param mixed $offer
     */
    public function setOffer($offer)
    {
        $this->offer = $offer;
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


   
}