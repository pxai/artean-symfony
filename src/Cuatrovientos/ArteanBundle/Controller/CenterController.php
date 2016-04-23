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
        $form = $this->createForm(new CenterType());
        return $this->render('CuatrovientosArteanBundle:Center:new.html.twig',array('form'=> $form->createView()));
    }

    /**
    *
    *
    */
    public function newSaveAction(Request $request)
    {
        $form = $this->createForm(new PostType(), new Post());
        if ($request->getMethod() == 'POST') {
            //$form->bind($request);
            $form->submit($request->request->get($form->getName()));
            if ($form->isValid()) {
                $center = $form->getData();

                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($center);
                $em->flush();
                $response =  $this->render('CuatrovientosArteanBundle:Center:newPostSave.html.twig', array('post' => $center));               
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Center:newPost.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }

    /**
    *
    *
    */
   public function detailAction($id=1)
    {

        $center = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Center")->find($id);
        
        $comment = new Comment();
        $comment->setPost($center);

        $form = $this->createForm(new CommentType(),$comment);
        return $this->render('CuatrovientosArteanBundle:Center:detail.html.twig',array('post'=> $center,'form'=>$form->createView()));
    }

    /**
    *
    *
    */
    public function updateAction($id) {
        $center = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Center")->find($id);
      
        $form = $this->createForm(new PostType(), $center);

        return $this->render('CuatrovientosArteanBundle:Center:updatePost.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }
    
    /**
    *
    *
    */
    public function updateSaveAction(Request $request) {
      
        $form = $this->createForm(new PostType(), new Post());
        $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            if ($form->isValid()) {
                $center = $form->getData();
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($center);
                $em->flush();
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:Center:detail', array('id' => $center->getId()));
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
   public function deleteAction($id=1)
    {
        $center = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Center")->find($id);
        return $this->render('CuatrovientosArteanBundle:Center:delete.html.twig',array('post'=> $center));
    }

    /**
    *
    *
    */
   public function deleteSaveAction(Post $center)
    {

       $em = $this->getDoctrine()->getEntityManager();
       $em->remove($center);
       $em->flush();
       return $this->forward('CuatrovientosArteanBundle:Center:index');
    }

}
