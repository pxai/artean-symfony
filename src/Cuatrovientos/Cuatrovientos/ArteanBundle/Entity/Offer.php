<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
 * @ORM\Table(name="tboffer")
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\OfferRepository")
 */
class Offer
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
     * @ORM\Column(name="company", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="functions", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $functions;

    /**
     * @var string
     *
     * @ORM\Column(name="position_no", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $position_no;

    /**
     * @var string
     *
     * @ORM\Column(name="workday", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $workday;

    /**
     * @var string
     *
     * @ORM\Column(name="required_studies", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $required_studies;

    /**
     * @var string
     *
     * @ORM\Column(name="required_languages", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $required_languages;

    /**
     * @var string
     *
     * @ORM\Column(name="other_knowledges", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $other_knowledges;

    /**
     * @var string
     *
     * @ORM\Column(name="observations", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $observations;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $contact;


}

