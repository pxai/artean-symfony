<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Fct;
use Cuatrovientos\ArteanBundle\Form\Type\FctSearchType;
use Cuatrovientos\ArteanBundle\Form\Type\FctType;


class FctController extends Controller
{

    public function indexAction($init=0,$limit=100)
    {
        $form = $this->createForm(FctSearchType::class);
        $fcts = $this->get("cuatrovientos_artean.bo.fct")->findAllFcts(0, $init, $limit);
        $total = $this->get("cuatrovientos_artean.bo.fct")->countAllFcts();
        return $this->render('CuatrovientosArteanBundle:Fct:index.html.twig', array('fcts'=>$fcts, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
    }


    public function searchAction(Request $request)
    {
        $form = $this->createForm(FctSearchType::class, new Fct());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $fct = $form->getData();
                $init = 0;
                $limit = 100;
                $fcts = $this->get("cuatrovientos_artean.bo.fct")->searchFcts($fct, 0, 100);
                $total = count($fcts);
                return $this->render('CuatrovientosArteanBundle:Fct:index.html.twig', array('fcts' => $fcts, 'init' => $init, 'limit' => $limit, 'total' => $total, 'form' => $form->createView()));

            }
        } else {
            $fcts = $this->get("cuatrovientos_artean.bo.fct")->findAllFcts(0, $init, $limit);
            $total = $this->get("cuatrovientos_artean.bo.fct")->countAllFcts();
            return $this->render('CuatrovientosArteanBundle:Fct:index.html.twig', array('fcts' => $fcts, 'init' => $init, 'limit' => $limit, 'total' => $total, 'form' => $form->createView()));
        }
    }


   public function newFctAction()
    {
        $form = $this->createForm(FctType::class, new Fct());
        return $this->render('CuatrovientosArteanBundle:Fct:new.html.twig', array('form'=> $form->createView()));
    }

    public function newFctSaveAction(Request $request)
    {
        $form = $this->createForm(FctType::class, new Fct());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            if ($form->isValid()) {
                $fct = $form->getData();

                $this->get("cuatrovientos_artean.bo.fct")->create($fct);

                return $this->forward('CuatrovientosArteanBundle:Fct:index');
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Fct:new.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }


   public function fctDetailAction($id=1)
    {

        $jobReques = $this->get("cuatrovientos_artean.bo.fct")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Fct:detail.html.twig',array('fct'=> $jobReques));
    }


    public function fctUpdateAction($id) {
        $fct = $this->get("cuatrovientos_artean.bo.fct")->selectById($id);
      
        $form = $this->createForm(FctType::class, $fct);

        return $this->render('CuatrovientosArteanBundle:Fct:update.html.twig',array('form'=> $form->createView(),'fct'=>$fct,'id'=>$id));
    }
    

    public function fctUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(FctType::class, new Fct());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $jobReques = $form->getData();

                $this->get("cuatrovientos_artean.bo.fct")->update($jobReques);
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:Fct:fctDetail', array('id' => $jobReques->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:Fct:updatePost.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }


   public function fctDeleteAction($id)
    {
        $fct = $this->get("cuatrovientos_artean.bo.fct")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Fct:delete.html.twig',array('fct'=> $fct));
    }


   public function fctDeleteSaveAction(Fct $fct)
    {
        $this->get("cuatrovientos_artean.bo.fct")->remove($fct);
       return $this->forward('CuatrovientosArteanBundle:Fct:index');
    }

}
