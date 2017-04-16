<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Course;
use Cuatrovientos\ArteanBundle\Service\DAO\CourseDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantDAO;

class CourseBusiness extends GenericBusiness {

    private $applicantDAO;

    public function __construct (CourseDAO $courseDAO,
                                 ApplicantDAO $applicantDAO) {
        $this->entityDAO = $courseDAO;
        $this->applicantDAO = $applicantDAO;
    }

    public function findAllCourses($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllCourses($id, $start,$total);
    }


    public function findCourses($term) {
        return $this->entityDAO->findCourses($term);
    }


    public function countAllCourses()
    {
        return $this->entityDAO->countAllCourses();
    }

    public function searchCourses($course, $start=0,$total=100)
    {
        return $this->entityDAO->searchCourses($course, $start, $total);
    }

}
