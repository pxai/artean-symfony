<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Center;
use Cuatrovientos\ArteanBundle\Form\Type\CenterType;

class CenterController extends Controller
{
    /**
    *
    *
    */
    public function indexAction()
    {
        //$centers = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Center")->findAll();
        $centers = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Center")->findCenters();
        return $this->render('CuatrovientosArteanBundle:Center:index.html.twig', array('centers'=>$centers));
    }

    /**
    *
    *
    */
   public function newCenterAction()
    {
        $form = $this->createForm(CenterType::class);
        return $this->render('CuatrovientosArteanBundle:Center:new.html.twig', array('form'=> $form->createView()));
    }

    /**
    *
    *
    */
    public function newCenterSaveAction(Request $request)
    {
        //$form = $this->createForm(new CenterType(), new Center());
        $form = $this->createForm(CenterType::class, new Center());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            //$form->submit($request->request->get($form->getName()));
            
            if ($form->isValid()) {
                $center = $form->getData();
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($center);
                $em->flush();
                $response =  $this->render('CuatrovientosArteanBundle:Center:newSave.html.twig', array('center' => $center));               
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Center:new.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }

    /**
    *
    *
    */
   public function centerDetailAction($id=1)
    {

        $center = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Center")->find($id);
   
        return $this->render('CuatrovientosArteanBundle:Center:detail.html.twig',array('center'=> $center));
    }

    /**
    *
    *
    */
    public function centerUpdateAction($id) {
        $center = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Center")->find($id);
      
        $form = $this->createForm(CenterType::class, $center);

        return $this->render('CuatrovientosArteanBundle:Center:update.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }
    
    /**
    *
    *
    */
    public function centerUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(CenterType::class, new Center());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $center = $form->getData();
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($center);
                $em->flush();
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:Center:centerDetail', array('id' => $center->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:Center:updatePost.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    /**
    *
    *
    */
   public function centerDeleteAction($id=1)
    {
        $center = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Center")->find($id);
        return $this->render('CuatrovientosArteanBundle:Center:delete.html.twig',array('center'=> $center));
    }

    /**
    *
    *
    */
   public function centerDeleteSaveAction(Center $center)
    {

       $em = $this->getDoctrine()->getEntityManager();
       $em->remove($center);
       $em->flush();
       return $this->forward('CuatrovientosArteanBundle:Center:index');
    }

}
