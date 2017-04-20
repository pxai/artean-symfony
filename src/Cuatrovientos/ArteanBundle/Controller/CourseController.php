<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Course;
use Cuatrovientos\ArteanBundle\Entity\StudentCourse;
use Cuatrovientos\ArteanBundle\Form\Type\CourseType;
use Cuatrovientos\ArteanBundle\Form\Type\StudentCourseType;

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
        $form = $this->createForm(StudentCourseType::class, new StudentCourse());
        $course = $this->get("cuatrovientos_artean.bo.course")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Course:detail.html.twig',array('course'=> $course,'form'=>$form->createView()));
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

}
