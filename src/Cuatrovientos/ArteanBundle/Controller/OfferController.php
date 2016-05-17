<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Offer;
use Cuatrovientos\ArteanBundle\Entity\OfferOpen;
use Cuatrovientos\ArteanBundle\Form\Type\OfferType;

class OfferController extends Controller
{
    /**
    *
    *
    */
    public function indexAction()
    {
        //$offers = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Offer")->findAll();
        $offers = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Offer")->findOffer();
        return $this->render('CuatrovientosArteanBundle:Offer:index.html.twig', array('offers'=>$offers));
    }  
    
    /**
    *
    *
    */
   public function newOfferOpenAction()
    {
        $form = $this->createForm(OfferType::class);
        return $this->render('CuatrovientosArteanBundle:Offer:newOpen.html.twig', array('form'=> $form->createView()));
    }

    /**
    *
    *
    */
    public function newOfferSaveOpenAction(Request $request)
    {
        //$form = $this->createForm(new OfferType(), new Offer());
        $form = $this->createForm(OfferType::class, new OfferOpen());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            //$form->submit($request->request->get($form->getName()));
            
            if ($form->isValid()) {
                $offer = $form->getData();
                
               // $em = $this->getDoctrine()->getEntityManager();
               // $em->merge($offer);
               // $em->flush();
                $response =  $this->render('CuatrovientosArteanBundle:Offer:newSave.html.twig', array('offer' => $offer));               
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Offer:new.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }

    /**
    *
    *
    */
   public function offerDetailAction($id=1)
    {

        $offer = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Offer")->find($id);
   
        return $this->render('CuatrovientosArteanBundle:Offer:detail.html.twig',array('offer'=> $offer));
    }

    /**
    *
    *
    */
    public function offerUpdateAction($id) {
        $offer = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Offer")->find($id);
      
        $form = $this->createForm(OfferType::class, $offer);

        return $this->render('CuatrovientosArteanBundle:Offer:update.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }
    
    /**
    *
    *
    */
    public function offerUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(OfferType::class, new Offer());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $offer = $form->getData();
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($offer);
                $em->flush();
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:Offer:offerDetail', array('id' => $offer->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:Offer:updatePost.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    /**
    *
    *
    */
   public function offerDeleteAction($id=1)
    {
        $offer = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Offer")->find($id);
        return $this->render('CuatrovientosArteanBundle:Offer:delete.html.twig',array('offer'=> $offer));
    }

    /**
    *
    *
    */
   public function offerDeleteSaveAction(Offer $offer)
    {

       $em = $this->getDoctrine()->getEntityManager();
       $em->remove($offer);
       $em->flush();
       return $this->forward('CuatrovientosArteanBundle:Offer:index');
    }

}
