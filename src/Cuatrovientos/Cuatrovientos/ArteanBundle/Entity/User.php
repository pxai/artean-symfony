<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="f_users")
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\UserRepository")
 */
class User
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
     * @ORM\Column(name="login", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="fullname", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $fullname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="since", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $since;

    /**
     * @var string
     *
     * @ORM\Column(name="validate", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $validate;

    /**
     * @var integer
     *
     * @ORM\Column(name="lopd", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $lopd;


}

