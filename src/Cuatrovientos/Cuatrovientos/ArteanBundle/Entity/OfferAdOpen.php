<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfferAdOpen
 *
 * @ORM\Table(name="ofertas")
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\OfferRepository")
 */
class OfferAdOpen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="codcentro", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="puesto", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcionoferta", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="vacantes", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $position_no;

    /**
     * @var string
     *
     * @ORM\Column(name="jornada", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $workday;

    /**
     * @var array
     *
     * @ORM\Column(name="estudiosrequeridos", type="array", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $required_studies;

    /**
     * @var array
     *
     * @ORM\Column(name="idiomas", type="array", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $required_languages;

    /**
     * @var string
     *
     * @ORM\Column(name="requisitos", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $other_knowledges;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $observations;

    /**
     * @var \Cuatrovientos\ArteanBundle\Entity\ContractType
     *
     * @ORM\ManyToOne(targetEntity="Cuatrovientos\ArteanBundle\Entity\ContractType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipocontrato", referencedColumnName="id", nullable=true)
     * })
     */
    private $contract_type;


}

