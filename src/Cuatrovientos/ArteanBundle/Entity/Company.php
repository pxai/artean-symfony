<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="Cuatrovientos\ArteanBundle\EntityRepository\CompanyRepository")
 * @ORM\Table(name="tbempresas")
 */
class Company  extends Entity
{

    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="cif",type="string", length=15)
     */
    private $cif;

    /**
     * @ORM\Column(name="empresa",type="string", length=70)
     */
    private $empresa;

    /**
     * @ORM\Column(name="contacto",type="string", length=255)
     */
    private $contacto;

    /**
     * @ORM\Column(name="actividad",type="string", length=60)
     */
    private $actividad;

    /**
     * @ORM\Column(name="direccion",type="string", length=100)
     */
    private $direccion;

    /**
     * @ORM\Column(name="poblacion",type="string", length=100)
     */
    private $poblacion = 'Pamplona/Iruñea';

    /**
     * @ORM\Column(name="provincia",type="string", length=100)
     */
    private $provincia = 'Navarra/Nafarroa';

    /**
     * @ORM\Column(name="codigpostal",type="string", length=10)
     */
    private $codigpostal = '31004';

    /**
     * @ORM\Column(name="telefono",type="string", length=30)
     */
    private $telefono;

    /**
     * @ORM\Column(name="fax",type="string", length=30)
     */
    private $fax;

    /**
     * @ORM\Column(name="email",type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(name="web",type="string", length=100)
     */
    private $web;

    /**
     * @ORM\Column(name="fechaalta",type="string", length=100)
     */
    private $fechaalta;

    /**
     * @ORM\Column(name="fechaactualizacion",type="string", length=100)
     */
    private $fechaactualizacion;

    /**
     * @ORM\Column(name="baja",type="integer")
     */
    private $baja;

    /**
     * @ORM\Column(name="fechabaja",type="string", length=100)
     */
    private $fechabaja;


    /**
     * @ORM\Column(name="pbservaciones",type="string", length=255)
     */
    private $pbservaciones;

    /**
     * @ORM\Column(name="fct",type="integer")
     */
    private $fct;


    /**
     * @ORM\Column(name="convenio",type="string", length=15)
     */
    private $convenio;

    /**
     * @ORM\Column(name="convenio_pip",type="string", length=15)
     */
    private $convenio_pip;

    /**
     * @ORM\Column(name="convenio_dual",type="string", length=15)
     */
    private $convenio_dual;

    /**
     * @ORM\Column(name="convenio_pipdual",type="string", length=15)
     */
    private $convenio_pipdual;

    /**
     * @ORM\OneToMany(targetEntity="CompanyDegrees", mappedBy="company",fetch="EXTRA_LAZY")
     */
    private $degrees;

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
    public function getCif()
    {
        return $this->cif;
    }

    /**
     * @param mixed $cif
     */
    public function setCif($cif)
    {
        $this->cif = $cif;
    }

    /**
     * @return mixed
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * @param mixed $empresa
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }

    /**
     * @return mixed
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * @param mixed $contacto
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;
    }

    /**
     * @return mixed
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * @param mixed $actividad
     */
    public function setActividad($actividad)
    {
        $this->actividad = $actividad;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return mixed
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    /**
     * @param mixed $poblacion
     */
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;
    }

    /**
     * @return mixed
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * @param mixed $provincia
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    /**
     * @return mixed
     */
    public function getCodigpostal()
    {
        return $this->codigpostal;
    }

    /**
     * @param mixed $codigpostal
     */
    public function setCodigpostal($codigpostal)
    {
        $this->codigpostal = $codigpostal;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param mixed $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * @param mixed $web
     */
    public function setWeb($web)
    {
        $this->web = $web;
    }

    /**
     * @return mixed
     */
    public function getFechaalta()
    {
        return $this->fechaalta;
    }

    /**
     * @param mixed $fechaalta
     */
    public function setFechaalta($fechaalta)
    {
        $this->fechaalta = $fechaalta;
    }

    /**
     * @return mixed
     */
    public function getFechaactualizacion()
    {
        return $this->fechaactualizacion;
    }

    /**
     * @param mixed $fechaactualizacion
     */
    public function setFechaactualizacion($fechaactualizacion)
    {
        $this->fechaactualizacion = $fechaactualizacion;
    }

    /**
     * @return mixed
     */
    public function getBaja()
    {
        return $this->baja;
    }

    /**
     * @param mixed $baja
     */
    public function setBaja($baja)
    {
        $this->baja = $baja;
    }

    /**
     * @return mixed
     */
    public function getFechabaja()
    {
        return $this->fechabaja;
    }

    /**
     * @param mixed $fechabaja
     */
    public function setFechabaja($fechabaja)
    {
        $this->fechabaja = $fechabaja;
    }

    /**
     * @return mixed
     */
    public function getPbservaciones()
    {
        return $this->pbservaciones;
    }

    /**
     * @param mixed $pbservaciones
     */
    public function setPbservaciones($pbservaciones)
    {
        $this->pbservaciones = $pbservaciones;
    }

    /**
     * @return mixed
     */
    public function getFct()
    {
        return $this->fct;
    }

    /**
     * @param mixed $fct
     */
    public function setFct($fct)
    {
        $this->fct = $fct;
    }

    /**
     * @return mixed
     */
    public function getConvenio()
    {
        return $this->convenio;
    }

    /**
     * @param mixed $convenio
     */
    public function setConvenio($convenio)
    {
        $this->convenio = $convenio;
    }

    /**
     * @return mixed
     */
    public function getConvenioPip()
    {
        return $this->convenio_pip;
    }

    /**
     * @param mixed $convenio_pip
     */
    public function setConvenioPip($convenio_pip)
    {
        $this->convenio_pip = $convenio_pip;
    }

    /**
     * @return mixed
     */
    public function getConvenioDual()
    {
        return $this->convenio_dual;
    }

    /**
     * @param mixed $convenio_dual
     */
    public function setConvenioDual($convenio_dual)
    {
        $this->convenio_dual = $convenio_dual;
    }

    /**
     * @return mixed
     */
    public function getConvenioPipdual()
    {
        return $this->convenio_pipdual;
    }

    /**
     * @param mixed $convenio_pipdual
     */
    public function setConvenioPipdual($convenio_pipdual)
    {
        $this->convenio_pipdual = $convenio_pipdual;
    }

    /**
     * @return mixed
     */
    public function getDegrees()
    {
        return $this->degrees;
    }

    /**
     * @param mixed $degrees
     */
    public function setDegrees($degrees)
    {
        $this->degrees = $degrees;
    }



    function __toString()
    {
        return $this->empresa;
    }


}