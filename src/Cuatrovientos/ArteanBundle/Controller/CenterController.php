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
    public function indexAction($init=0,$limit=100) {
        $form = $this->createForm(CenterType::class);
        $centers = $this->get("cuatrovientos_artean.bo.center")->findAllCenters(0, $init, $limit);
        $total = $this->get("cuatrovientos_artean.bo.center")->countAllCenters();
        return $this->render('CuatrovientosArteanBundle:Center:index.html.twig', array('centers'=>$centers, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
    }

    public function searchAction(Request $request)
    {
        $form = $this->createForm(CenterType::class, new Center());
        $init = 0;
        $limit = 100;

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $center = $form->getData();

                $centers = $this->get("cuatrovientos_artean.bo.center")->searchCenters($center, 0, 100);
                $total = count($center);
                return $this->render('CuatrovientosArteanBundle:Center:index.html.twig', array('centers' => $centers, 'init' => $init, 'limit' => $limit, 'total' => $total, 'form' => $form->createView()));
            }
        } else {
            $centers = $this->get("cuatrovientos_artean.bo.center")->findAllCenters(0, $init, $limit);
            $total = $this->get("cuatrovientos_artean.bo.center")->countAllCenters();
            return $this->render('CuatrovientosArteanBundle:Center:index.html.twig', array('centers'=>$centers, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
        }
    }

   public function newCenterAction()
    {
        $form = $this->createForm(CenterType::class);
        return $this->render('CuatrovientosArteanBundle:Center:new.html.twig', array('form'=> $form->createView()));
    }


    public function newCenterSaveAction(Request $request)
    {
        //$form = $this->createForm(new CenterType(), new Center());
        $form = $this->createForm(CenterType::class, new Center());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $center = $form->getData();
                $this->get("cuatrovientos_artean.bo.center")->create($center);
                $response =  $this->redirectToRoute("cuatrovientos_artean_center");
                //$response =  $this->render('CuatrovientosArteanBundle:Center:newSave.html.twig', array('center' => $center));
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Center:new.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }


   public function centerDetailAction($id=1)
    {
        $center = $this->get("cuatrovientos_artean.bo.center")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Center:detail.html.twig',array('center'=> $center));
    }


    public function centerUpdateAction($id) {
        $center = $this->get("cuatrovientos_artean.bo.center")->selectById($id);
        $form = $this->createForm(CenterType::class, $center);
        return $this->render('CuatrovientosArteanBundle:Center:update.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }
    

    public function centerUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(CenterType::class, new Center());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $center = $form->getData();

                $this->get("cuatrovientos_artean.bo.center")->update($center);
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:Center:centerDetail', array('id' => $center->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:Center:updatePost.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }


   public function centerDeleteAction($id=1)
    {
        $center = $this->get("cuatrovientos_artean.bo.center")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Center:delete.html.twig',array('center'=> $center));
    }

   public function centerDeleteSaveAction(Center $center)
    {
        $this->get("cuatrovientos_artean.bo.center")->remove($center);
       return $this->forward('CuatrovientosArteanBundle:Center:index');
    }

}
