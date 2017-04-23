<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Applicant
 *
 * @ORM\Table(name="tbalumnos")
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\ApplicantRepository")
 */
class Applicant
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonomovil", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="curriculum", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $cv;


}

