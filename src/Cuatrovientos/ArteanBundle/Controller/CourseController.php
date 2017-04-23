<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Course;
use Cuatrovientos\ArteanBundle\Entity\StudentCourse;
use Cuatrovientos\ArteanBundle\Entity\TeacherCourse;
use Cuatrovientos\ArteanBundle\Form\Type\CourseType;
use Cuatrovientos\ArteanBundle\Form\Type\StudentCourseType;
use Cuatrovientos\ArteanBundle\Form\Type\TeacherCourseType;

class CourseController extends Controller
{
    /**
    *
    *
    */
    public function indexAction($init=0,$limit=100) {
        $form = $this->createForm(CourseType::class);
        $courses = $this->get("cuatrovientos_artean.bo.course")->findAllCourses(0, $init, $limit);
        $total = $this->get("cuatrovientos_artean.bo.course")->countAllCourses();
        return $this->render('CuatrovientosArteanBundle:Course:index.html.twig', array('courses'=>$courses, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
    }

    public function searchAction(Request $request)
    {
        $form = $this->createForm(CourseType::class, new Course());
        $init = 0;
        $limit = 100;

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $course = $form->getData();

                $courses = $this->get("cuatrovientos_artean.bo.course")->searchCourses($course, 0, 100);
                $total = count($course);
                return $this->render('CuatrovientosArteanBundle:Course:index.html.twig', array('courses' => $courses, 'init' => $init, 'limit' => $limit, 'total' => $total, 'form' => $form->createView()));
            }
        } else {
            $courses = $this->get("cuatrovientos_artean.bo.course")->findAllCourses(0, $init, $limit);
            $total = $this->get("cuatrovientos_artean.bo.course")->countAllCourses();
            return $this->render('CuatrovientosArteanBundle:Course:index.html.twig', array('courses'=>$courses, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
        }
    }

   public function newCourseAction()
    {
        $form = $this->createForm(CourseType::class);
        return $this->render('CuatrovientosArteanBundle:Course:new.html.twig', array('form'=> $form->createView()));
    }


    public function newCourseSaveAction(Request $request)
    {
        //$form = $this->createForm(new CourseType(), new Course());
        $form = $this->createForm(CourseType::class, new Course());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $course = $form->getData();
                $this->get("cuatrovientos_artean.bo.course")->create($course);
                $response =  $this->redirectToRoute("cuatrovientos_artean_course");
                //$response =  $this->render('CuatrovientosArteanBundle:Course:newSave.html.twig', array('course' => $course));
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Course:new.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }


   public function courseDetailAction($id=1)
    {
        $studentCourse = new StudentCourse();
        $course = $this->get("cuatrovientos_artean.bo.course")->selectById($id);
        $studentCourse->setCourse($course);
        $form = $this->createForm(StudentCourseType::class, $studentCourse);
        $teacherCourse = new TeacherCourse();
        $teacherCourse->setCourse($course);
        $teacherForm = $this->createForm(TeacherCourseType::class, $teacherCourse);
        return $this->render('CuatrovientosArteanBundle:Course:detail.html.twig',array('course'=> $course,'form'=>$form->createView(),'teacherForm'=>$teacherForm->createView()));
    }


    public function courseUpdateAction($id) {
        $course = $this->get("cuatrovientos_artean.bo.course")->selectById($id);
        $form = $this->createForm(CourseType::class, $course);
        return $this->render('CuatrovientosArteanBundle:Course:update.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }
    

    public function courseUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(CourseType::class, new Course());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $course = $form->getData();

                $this->get("cuatrovientos_artean.bo.course")->update($course);
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:Course:courseDetail', array('id' => $course->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:Course:update.html.twig', array('form'=> $form->createView(),'id' => $course->getId()));
            }
        }
        return $response;
    }


   public function courseDeleteAction($id=1)
    {
        $course = $this->get("cuatrovientos_artean.bo.course")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Course:delete.html.twig',array('course'=> $course));
    }

   public function courseDeleteSaveAction(Course $course)
    {
        $this->get("cuatrovientos_artean.bo.course")->remove($course);
       return $this->forward('CuatrovientosArteanBundle:Course:index');
    }

    public function newStudentCourseSaveAction(Request $request)
    {
        $form = $this->createForm(StudentCourseType::class, new StudentCourse());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $studentCourse = $form->getData();
                $this->get("cuatrovientos_artean.bo.course")->saveStudentCourse($studentCourse);
                return $this->courseDetailAction($studentCourse->getCourse()->getId());
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Course:new.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }

    public function studentCourseUpdateAction($id) {
        $studentCourse = $this->get("cuatrovientos_artean.bo.course")->selectStudentCourse($id);
        $form = $this->createForm(StudentCourseType::class, $studentCourse);
        return $this->render('CuatrovientosArteanBundle:Course/StudentCourse:update.html.twig',array('form'=> $form->createView(), 'studentCourse' => $studentCourse,'id'=>$id));
    }

    public function studentCourseUpdateSaveAction(Request $request)
    {
        $form = $this->createForm(StudentCourseType::class, new StudentCourse());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            $studentCourse = $form->getData();
            if ($form->isValid()) {

               $this->get("cuatrovientos_artean.bo.course")->updateStudentCourse($studentCourse);
                return $this->courseDetailAction($studentCourse->getCourse()->getId());
            } else {
                return $this->courseDetailAction($studentCourse->getCourse()->getId());
               }
        }
        return $this->indexAction();
    }

    public function studentCourseDeleteSaveAction($id=1)
    {
        $studentCourse = $this->get("cuatrovientos_artean.bo.course")->selectStudentCourse($id);
        $this->get("cuatrovientos_artean.bo.course")->deleteStudentCourse($studentCourse);
        return $this->courseDetailAction($studentCourse->getCourse()->getId());
    }

    public function newTeacherCourseSaveAction(Request $request)
    {
        $form = $this->createForm(TeacherCourseType::class, new TeacherCourse());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $teacherCourse = $form->getData();
                $this->get("cuatrovientos_artean.bo.course")->saveTeacherCourse($teacherCourse);
                return $this->courseDetailAction($teacherCourse->getCourse()->getId());
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Course:new.html.twig', array('form'=> $form->createView()));
            }
        }

        return $this->indexAction();
    }

    public function teacherCourseDeleteSaveAction($id=1)
    {
        $teacherCourse = $this->get("cuatrovientos_artean.bo.course")->selectTeacherCourse($id);
        $this->get("cuatrovientos_artean.bo.course")->deleteTeacherCourse($teacherCourse);
        return $this->courseDetailAction($teacherCourse->getCourse()->getId());
    }
}
