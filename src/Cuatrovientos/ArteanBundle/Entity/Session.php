<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="f_session")
 */
class Session
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\Column(name="userid",type="integer")
     */
    private $userid;

     /**
     * @ORM\Column(name="seskey",type="string", length=100)
     */
    private $sesskey;

     /**
     * @ORM\Column(name="since",type="integer")
     */
    private $since;

     /**
     * @ORM\Column(name="active",type="integer")
     */
    private $active=1;


    public function __construct () {
        $this->since= time();
        $this->active = 1;
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

    
    public function getUserid() {
        return $this->userid;
    }

    public function getSesskey() {
        return $this->sesskey;
    }

    public function getSince() {
        return $this->since;
    }

    public function getActive() {
        return $this->active;
    }

    public function setUserid($userid) {
        $this->userid = $userid;
    }

    public function setSesskey($sesskey) {
        $this->sesskey = $sesskey;
    }

    public function setSince($since) {
        $this->since = $since;
    }

    public function setActive($active) {
        $this->active = $active;
    }


   
}