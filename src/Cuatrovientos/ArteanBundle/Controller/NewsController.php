<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\News;
use Cuatrovientos\ArteanBundle\Form\Type\NewsType;

class NewsController extends Controller
{
    /**
    *
    *
    */
    public function indexAction()
    {
        //$newss = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:News")->findAll();
        $newss = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:News")->findNewss();
        return $this->render('CuatrovientosArteanBundle:News:index.html.twig', array('newss'=>$newss));
    }

    /**
    *
    *
    */
   public function newNewsAction()
    {
        $form = $this->createForm(NewsType::class);
        return $this->render('CuatrovientosArteanBundle:News:new.html.twig', array('form'=> $form->createView()));
    }

    /**
    *
    *
    */
    public function newNewsSaveAction(Request $request)
    {
        //$form = $this->createForm(new NewsType(), new News());
        $form = $this->createForm(NewsType::class, new News());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            //$form->submit($request->request->get($form->getName()));
            
            if ($form->isValid()) {
                $news = $form->getData();
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($news);
                $em->flush();
                $response =  $this->render('CuatrovientosArteanBundle:News:newSave.html.twig', array('news' => $news));               
            } else {
                $response = $this->render('CuatrovientosArteanBundle:News:new.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }

    /**
    *
    *
    */
   public function newsDetailAction($id=1)
    {

        $news = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:News")->find($id);
   
        return $this->render('CuatrovientosArteanBundle:News:detail.html.twig',array('news'=> $news));
    }

    /**
    *
    *
    */
    public function newsUpdateAction($id) {
        $news = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:News")->find($id);
      
        $form = $this->createForm(NewsType::class, $news);

        return $this->render('CuatrovientosArteanBundle:News:update.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }
    
    /**
    *
    *
    */
    public function newsUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(NewsType::class, new News());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $news = $form->getData();
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($news);
                $em->flush();
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:News:newsDetail', array('id' => $news->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:News:updatePost.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    /**
    *
    *
    */
   public function newsDeleteAction($id=1)
    {
        $news = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:News")->find($id);
        return $this->render('CuatrovientosArteanBundle:News:delete.html.twig',array('news'=> $news));
    }

    /**
    *
    *
    */
   public function newsDeleteSaveAction(News $news)
    {

       $em = $this->getDoctrine()->getEntityManager();
       $em->remove($news);
       $em->flush();
       return $this->forward('CuatrovientosArteanBundle:News:index');
    }

}
