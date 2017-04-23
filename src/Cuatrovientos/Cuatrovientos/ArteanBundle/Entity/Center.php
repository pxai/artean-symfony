<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Center
 *
 * @ORM\Table(name="tbcentros")
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\CenterRepository")
 */
class Center
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
     * @ORM\Column(name="nombrecentro", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;


}

