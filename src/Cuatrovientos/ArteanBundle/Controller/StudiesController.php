<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Studies;
use Cuatrovientos\ArteanBundle\Form\Type\StudiesType;

class StudiesController extends Controller
{
    /**
    *
    *
    */
    public function indexAction($init=0,$limit=100) {
        $form = $this->createForm(StudiesType::class);
        $studies = $this->get("cuatrovientos_artean.bo.studies")->findAllStudies(0, $init, $limit);
        $total = $this->get("cuatrovientos_artean.bo.studies")->countAllStudies();
        return $this->render('CuatrovientosArteanBundle:Studies:index.html.twig', array('studies'=>$studies, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
    }

    public function searchAction(Request $request)
    {
        $form = $this->createForm(StudiesType::class, new Studies());
        $init = 0;
        $limit = 100;

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $studies = $form->getData();

                $studies = $this->get("cuatrovientos_artean.bo.studies")->searchStudies($studies, 0, 100);
                $total = count($studies);
                return $this->render('CuatrovientosArteanBundle:Studies:index.html.twig', array('studies' => $studies, 'init' => $init, 'limit' => $limit, 'total' => $total, 'form' => $form->createView()));
            }
        } else {
            $studies = $this->get("cuatrovientos_artean.bo.studies")->findAllStudies(0, $init, $limit);
            $total = $this->get("cuatrovientos_artean.bo.studies")->countAllStudies();
            return $this->render('CuatrovientosArteanBundle:Studies:index.html.twig', array('studies'=>$studies, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
        }
    }

   public function newStudiesAction()
    {
        $form = $this->createForm(StudiesType::class);
        return $this->render('CuatrovientosArteanBundle:Studies:new.html.twig', array('form'=> $form->createView()));
    }


    public function newStudiesSaveAction(Request $request)
    {
        //$form = $this->createForm(new StudiesType(), new Studies());
        $form = $this->createForm(StudiesType::class, new Studies());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $studies = $form->getData();
                $this->get("cuatrovientos_artean.bo.studies")->create($studies);
                $response =  $this->render('CuatrovientosArteanBundle:Studies:newSave.html.twig', array('studies' => $studies));               
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Studies:new.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }


   public function studiesDetailAction($id=1)
    {
        $studies = $this->get("cuatrovientos_artean.bo.studies")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Studies:detail.html.twig',array('studies'=> $studies));
    }


    public function studiesUpdateAction($id) {
        $studies = $this->get("cuatrovientos_artean.bo.studies")->selectById($id);
        $form = $this->createForm(StudiesType::class, $studies);
        return $this->render('CuatrovientosArteanBundle:Studies:update.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }
    

    public function studiesUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(StudiesType::class, new Studies());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $studies = $form->getData();

                $this->get("cuatrovientos_artean.bo.studies")->update($studies);
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:Studies:studiesDetail', array('id' => $studies->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:Studies:updatePost.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }


   public function studiesDeleteAction($id=1)
    {
        $studies = $this->get("cuatrovientos_artean.bo.studies")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Studies:delete.html.twig',array('studies'=> $studies));
    }

   public function studiesDeleteSaveAction(Studies $studies)
    {
        $this->get("cuatrovientos_artean.bo.studies")->remove($studies);
       return $this->forward('CuatrovientosArteanBundle:Studies:index');
    }

}
