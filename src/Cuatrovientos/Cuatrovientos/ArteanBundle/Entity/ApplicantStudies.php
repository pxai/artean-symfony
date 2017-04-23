<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ApplicantStudies
 *
 * @ORM\Table(name="tbalumnosestudios")
 * @ORM\Entity
 */
class ApplicantStudies
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="idapplicant", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idapplicant;

    /**
     * @var integer
     *
     * @ORM\Column(name="codestudios", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idstudies;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="codcentro", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idcenter;

    /**
     * @var integer
     *
     * @ORM\Column(name="anofin", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $endyear;


}

