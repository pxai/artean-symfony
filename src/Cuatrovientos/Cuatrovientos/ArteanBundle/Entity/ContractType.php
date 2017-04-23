<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContractType
 *
 * @ORM\Table(name="tbtiposcontrato")
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\ContractTypeRepository")
 */
class ContractType
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
     * @ORM\Column(name="tipocontrato", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;


}

