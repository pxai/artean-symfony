<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\NewsRepository")
 * @ORM\Table(name="news")
 */
class News extends Entity
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\Column(name="permalink",type="string", length=50)
     */
    private $permalink;
  
     /**
     * @ORM\Column(name="title",type="string", length=50)
     */
    private $title;

     /**
     * @ORM\Column(name="what",type="string", length=50)
     */
    private $what;

     /**
     * @ORM\Column(name="newsdate",type="integer")
     */
    private $newsdate;

     /**
     * @ORM\Column(name="who",type="integer")
     */
    private $who;

     /**
     * @ORM\Column(name="status",type="integer")
     */
    private $status;

     /**
     * @ORM\Column(name="tags",type="string", length=255)
     */
    private $tags;

         
    public function __construct () {
        $this->newsdate = time();
        $this->who = 1;
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
    
    public function encodeContent () {
        $this->what = base64_encode($this->what);
    }

    public function decodeContent () {
        $this->what = base64_decode($this->what);
    }

    
    public function getPermalink() {
        return $this->permalink;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getWhat() {
        $this->decodeContent();
        return $this->what;
    }

    public function getNewsdate() {
        return $this->newsdate;
    }

    public function getWho() {
        return $this->who;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setPermalink($permalink) {
        $this->permalink = $permalink;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setWhat($what) {
        $this->what = $what;
    }

    public function setNewsdate($newsdate) {
        $this->newsdate = $newsdate;
    }

    public function setWho($who) {
        $this->who = $who;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function getTags() {
        return $this->tags;
    }

    public function setTags($tags) {
        $this->tags = $tags;
    }


    
}