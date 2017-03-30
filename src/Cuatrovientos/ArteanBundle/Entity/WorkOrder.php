<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\WorkOrderRepository")
 * @ORM\Table(name="tbworkorder")
 */
class WorkOrder
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="idapplicant",type="integer")
     */
    private $idapplicant;
    
     /**
     * @ORM\Column(name="description",type="string", length=1024)
     */
    private $description;

    /**
     * @ORM\Column(name="hours",type="float")
     */
    private $hours;
    
    /**
     * @ORM\Column(name="order_date",type="date", length=50)
     */
    private $orderDate;
    
    public function __construct () {
    }

    /**
    *
    */
    public function getId () {
      return $this->id;  
    }
    
    /**
    *
    */
    public function setId ($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdapplicant()
    {
        return $this->idapplicant;
    }

    /**
     * @param mixed $idapplicant
     */
    public function setIdapplicant($idapplicant)
    {
        $this->idapplicant = $idapplicant;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @param mixed $orderDate
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
    }

    /**
     * @return mixed
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * @param mixed $hours
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
    }

    

   
}