<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Session
 *
 * @ORM\Table(name="f_session")
 * @ORM\Entity
 */
class Session
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
     * @ORM\Column(name="userid", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="seskey", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $sesskey;

    /**
     * @var integer
     *
     * @ORM\Column(name="since", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $since;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $active;


}

