<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WorkOrder
 *
 * @ORM\Table(name="tbworkorder")
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\WorkOrderRepository")
 */
class WorkOrder
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1024, precision=0, scale=0, nullable=false, unique=false)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="hours", type="float", precision=0, scale=0, nullable=false, unique=false)
     */
    private $hours;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_date", type="date", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $orderDate;


}

