<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\NewsRepository")
 */
class News
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
     * @ORM\Column(name="permalink", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $permalink;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="what", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $what;

    /**
     * @var integer
     *
     * @ORM\Column(name="newsdate", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $newsdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="who", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $who;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $tags;


}

