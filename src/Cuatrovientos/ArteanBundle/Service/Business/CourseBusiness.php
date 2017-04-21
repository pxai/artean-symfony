<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Course;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Service\DAO\CourseDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\StudentCourseDAO;

class CourseBusiness extends GenericBusiness {

    private $applicantDAO;
    private $studentCourseDAO;

    public function __construct (CourseDAO $courseDAO,
                                 ApplicantDAO $applicantDAO,
                                 StudentCourseDAO $studentCourseDAO) {
        $this->entityDAO = $courseDAO;
        $this->applicantDAO = $applicantDAO;
        $this->studentCourseDAO = $studentCourseDAO;
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

    public function selectStudentCourse($id) {
        return $this->studentCourseDAO->selectById($id);
    }

    public function saveStudentCourse($applicantCourse) {
        $this->setCourseApplicant($applicantCourse);
        $this->studentCourseDAO->create($applicantCourse);
    }

    public function updateStudentCourse($applicantCourse) {
        $this->setCourseApplicant($applicantCourse);
        $this->studentCourseDAO->update($applicantCourse);
    }

    public function deleteStudentCourse($applicantCourse) {
        $this->studentCourseDAO->remove($applicantCourse);
    }


    private function setCourseApplicant($applicantCourse)
    {
        if (preg_match("/^[0-9]+$/", $applicantCourse->getApplicantName())) {
            // Check that exists
            if ($applicant = $this->applicantDAO->selectById($applicantCourse->getApplicantName())) {
                $applicantCourse->setApplicant($applicant);
            } else { // else, insert that number as the name
                $applicantCourse->setNewApplicant();
            }
        } else { // Else, new Applicant must be created
            $applicant = new Applicant();
            $applicant->setName($applicantCourse->getApplicantName());
            $this->applicantDAO->create($applicant);
            $applicantCourse->setApplicant($applicant);
        }
    }
}
