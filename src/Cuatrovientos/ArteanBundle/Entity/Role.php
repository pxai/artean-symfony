<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="f_roles")
 */
class Role extends Entity implements RoleInterface
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name",type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(name="description",type="string", length=100)
     */
    private $description;

    /**
     * @ORM\Column(name="active",type="integer")
     */
    private $active;
  

    public function __construct () {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * Return the role field.
     * @return string
     */
    public function getRole()
    {
        return $this->name;
    }

    /**
     * Return the role field.
     * @return string
     */
    public function __toString()
    {
        return (string) $this->name;
    }

   
}