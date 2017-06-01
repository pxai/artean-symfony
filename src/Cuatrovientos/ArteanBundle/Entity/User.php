<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\UserRepository")
 * @ORM\Table(name="f_users")
 */
class User extends Entity implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\Column(name="login",type="string", length=50)
     */
    private $login;
  
     /**
     * @ORM\Column(name="password",type="string", length=100)
     */
    private $password;

     /**
     * @ORM\Column(name="fullname",type="string", length=50)
     */
    private $fullname;

     /**
     * @ORM\Column(name="email",type="string", length=100)
     */
    private $email;

         /**
     * @ORM\Column(name="url",type="string", length=100)
     */
    private $url = '';

     /**
     * @ORM\Column(name="since",type="integer")
     */
    private $since;

    
         /**
     * @ORM\Column(name="validate",type="string", length=100)
     */
    private $validate = '';

         /**
     * @ORM\Column(name="lopd",type="integer")
     */
    private $lopd = 1;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="f_users_has_roles",
     *      joinColumns={@ORM\JoinColumn(name="iduser", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="idrole", referencedColumnName="id")}
     *      )
     */
    private $roles;

    public function __construct () {
        $this->since = time();
        $this->roles = array();
    }

    public function randPassword( $length = 8, $chars = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789' ) {
        return substr( str_shuffle( $chars ), 0, $length );
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


    public function getLogin() {
        return $this->login;
    }
    
    public function getUsername() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFullname() {
        return $this->fullname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getSince() {
        return $this->since;
    }

    public function getValidate() {
        return $this->validate;
    }

    public function getLopd() {
        return $this->lopd;
    }
    
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }
    
   public function getRoles()
    {
       return $this->roles->toArray();
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->login,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }
    
     /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->login,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
    
    public function setLogin($login) {
        $this->login = $login;
    }

    public function setPassword($password) {
        $this->password = md5($password);
    }

    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setSince($since) {
        $this->since = $since;
    }

    public function setValidate($validate) {
        $this->validate = $validate;
    }

    public function setLopd($lopd) {
        $this->lopd = $lopd;
    }

}