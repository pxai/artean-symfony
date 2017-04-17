<?php

namespace Cuatrovientos\ArteanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbcourse")
 */
class Course extends Entity
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="codcursillo",type="string", length=50)
     */
    private $courseCode1;

    /**
     * @ORM\Column(name="codigo_cursillo",type="string", length=50)
     */
    private $courseCode2;

    /**
     * @ORM\Column(name="nombre_cursillo",type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(name="fecha_inicio",type="datetime", length=50)
     */
    private $startDate;

    /**
     * @ORM\Column(name="fecha_fin",type="datetime", length=50)
     */
    private $endDate;

    /**
     * @ORM\Column(name="horas",type="string", length=14)
     */
    private $hours;

    /**
     * @ORM\Column(name="horario",type="string", length=255)
     */
    private $timetable;

    /**
     * @ORM\Column(name="lectivas_diarias",type="string", length=14)
     */
    private $classHoursDay;

    /**
     * @ORM\Column(name="horas__dia",type="string", length=14)
     */
    private $hoursDay;

    /**
     * @ORM\Column(name="tipo_curso",type="string", length=50)
     */
    private $courseType;

    /**
     * @ORM\Column(name="dias",type="string", length=12)
     */
    private $days;

    /**
     * @ORM\Column(name="familia",type="string", length=50)
     */
    private $family;

    /**
     * @ORM\Column(name="nivel",type="string", length=50)
     */
    private $level;

    /**
     * @ORM\Column(name="aula",type="string", length=100)
     */
    private $classroom;

    /**
     * @ORM\Column(name="comienzo_2_cuatrimestre",type="string", length=50)
     */
    private $startSecondTerm;

    /**
     * @ORM\Column(name="precio_1_cuatr",type="string", length=50)
     */
    private $priceFirstTerm;

    /**
     * @ORM\Column(name="precio_2_cuatr",type="string", length=50)
     */
    private $priceSecondTerm;

    /**
     * @ORM\Column(name="reserva_matr_",type="string", length=50)
     */
    private $book;


    public function __construct () {
        $this->startDate = new \DateTime();
        $this->endDate = new \DateTime();
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
    *
    */
    public function getName () {
      return $this->name;  
    }
    
    /**
    *
    */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCourseCode1()
    {
        return $this->courseCode1;
    }

    /**
     * @param mixed $courseCode1
     */
    public function setCourseCode1($courseCode1)
    {
        $this->courseCode1 = $courseCode1;
    }

    /**
     * @return mixed
     */
    public function getCourseCode2()
    {
        return $this->courseCode2;
    }

    /**
     * @param mixed $courseCode2
     */
    public function setCourseCode2($courseCode2)
    {
        $this->courseCode2 = $courseCode2;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
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

    /**
     * @return mixed
     */
    public function getTimetable()
    {
        return $this->timetable;
    }

    /**
     * @param mixed $timetable
     */
    public function setTimetable($timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * @return mixed
     */
    public function getClassHoursDay()
    {
        return $this->classHoursDay;
    }

    /**
     * @param mixed $classHoursDay
     */
    public function setClassHoursDay($classHoursDay)
    {
        $this->classHoursDay = $classHoursDay;
    }


    /**
     * @return mixed
     */
    public function getHoursDay()
    {
        return $this->hoursDay;
    }

    /**
     * @param mixed $hoursDay
     */
    public function setHoursDay($hoursDay)
    {
        $this->hoursDay = $hoursDay;
    }

    /**
     * @return mixed
     */
    public function getCourseType()
    {
        return $this->courseType;
    }

    /**
     * @param mixed $courseType
     */
    public function setCourseType($courseType)
    {
        $this->courseType = $courseType;
    }

    /**
     * @return mixed
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @param mixed $days
     */
    public function setDays($days)
    {
        $this->days = $days;
    }

    /**
     * @return mixed
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * @param mixed $family
     */
    public function setFamily($family)
    {
        $this->family = $family;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getClassroom()
    {
        return $this->classroom;
    }

    /**
     * @param mixed $classroom
     */
    public function setClassroom($classroom)
    {
        $this->classroom = $classroom;
    }

    /**
     * @return mixed
     */
    public function getStartSecondTerm()
    {
        return $this->startSecondTerm;
    }

    /**
     * @param mixed $startSecondTerm
     */
    public function setStartSecondTerm($startSecondTerm)
    {
        $this->startSecondTerm = $startSecondTerm;
    }

    /**
     * @return mixed
     */
    public function getPriceFirstTerm()
    {
        return $this->priceFirstTerm;
    }

    /**
     * @param mixed $priceFirstTerm
     */
    public function setPriceFirstTerm($priceFirstTerm)
    {
        $this->priceFirstTerm = $priceFirstTerm;
    }

    /**
     * @return mixed
     */
    public function getPriceSecondTerm()
    {
        return $this->priceSecondTerm;
    }

    /**
     * @param mixed $priceSecondTerm
     */
    public function setPriceSecondTerm($priceSecondTerm)
    {
        $this->priceSecondTerm = $priceSecondTerm;
    }

    /**
     * @return mixed
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * @param mixed $book
     */
    public function setBook($book)
    {
        $this->book = $book;
    }



    function __toString()
    {
        return $this->getName();
    }
}