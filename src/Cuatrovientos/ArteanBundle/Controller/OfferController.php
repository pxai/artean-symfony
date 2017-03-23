<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query\ResultSetMapping;
use Cuatrovientos\ArteanBundle\Entity\Offer;
use Cuatrovientos\ArteanBundle\Entity\News;
use Cuatrovientos\ArteanBundle\Entity\OfferOpen;
use Cuatrovientos\ArteanBundle\Form\Type\OfferType;
use Cuatrovientos\ArteanBundle\Form\Type\NewsType;

class OfferController extends Controller
{

    public function indexAction()
    {

        $offers = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:OfferOpen")->findOffers();
        return $this->render('CuatrovientosArteanBundle:Offer:index.html.twig' , array('offers'=>$offers));
    }  
    

   public function newOfferOpenAction()
    {
        $form = $this->createForm(OfferType::class);
        return $this->render('CuatrovientosArteanBundle:Offer:new.html.twig' , array('form'=> $form->createView()));
    }


    public function newOfferSaveOpenAction(Request $request)
    {
        //$form = $this->createForm(new OfferType(), new Offer());
        //$request->get('position')->set($request->request->get('company') .'=> , '. $request->request->get('position'));    
        $form = $this->createForm(OfferType::class, new OfferOpen());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            //$form->submit($request->request->get($form->getName()));
            
            if ($form->isValid()) {
                $offer = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($offer);
                $em->flush();
                $this->sendEmail($offer);
                $response =  $this->render('CuatrovientosArteanBundle:Offer:newSave.html.twig' , array('offer' => $offer));
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Offer:new.html.twig' , array('form'=> $form->createView()));
            }
        }

        return $response;
    }

    private function sendEmail ($offer) {
         $message = \Swift_Message::newInstance()
        ->setSubject('Artean: ¡nueva solicitud de empleo iniciada por empresa!')
        ->setFrom('artean@cuatrovientos.org')
        ->setTo('artean@cuatrovientos.org')
        ->setBcc('pello_altadill@cuatrovientos.org')
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'Emails/newOffer.html.twig' ,
                array('offer' => $offer)
            ),
            'text/html'
        );

        $this->get('mailer')->send($message);

    }


   public function offerDetailAction($id=1)
    {

        $offer = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:OfferOpen")->find($id);
   
        return $this->render('CuatrovientosArteanBundle:Offer:workOrder.html.twig' ,array('offer'=> $offer));
    }


    public function offerUpdateAction($id) {
        $offer = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Offer")->find($id);
      
        $form = $this->createForm(OfferType::class, $offer);

        return $this->render('CuatrovientosArteanBundle:Offer:update.html.twig' ,array('form'=> $form->createView(),'id'=>$id));
    }
    

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
                $response = $this->forward('CuatrovientosArteanBundle:Offer:offerDetail' , array('id' => $offer->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:Offer:updatePost.html.twig' , array('form'=> $form->createView()));
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
        $offer = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:OfferOpen")->find($id);
        return $this->render('CuatrovientosArteanBundle:Offer:delete.html.twig' ,array('offer'=> $offer));
    }

    /**
    *
    *
    */
   public function offerDeleteSaveAction(OfferOpen $offer)
    {
        $rsm = new ResultSetMapping();
       $em = $this->getDoctrine()->getEntityManager();
        
        // problems executing this, fot update, delete and insert not the best option
        // ?,?,?
        // Instead using prepared

        $sql = 'insert into tbsolicitudes (fechasolicitud, idempresa, att, saludo, contacto, descripcionempresa,horario, contrato,formacion, idiomas, vacantes, jornada,requisitos,perfil)
                  values (:fechasolicitud, 
                            :idempresa, 
                            :att, 
                            :saludo, 
                            :contacto, 
                            :descripcionempresa,
                            :horario, 
                            :contrato,
                            :formacion, 
                            :idiomas, 
                            :vacantes, 
                            :jornada,
                            :requisitos,
                            :perfil   
                  )';

        $params = array(
            'fechasolicitud' => date('d/M/Y'),
            'idempresa'=> 1,
            'att'=> 'Att',
            'saludo'=> 'Estimada/o',
            'contacto'=> $offer->getContact(),
            'descripcionempresa'=> $offer->getCompany().', ' .$offer->getDescription(),
            'horario'=> $offer->getSchedule(),
            'contrato'=> $offer->getContractType()->getId(),
            'formacion'=> $offer->getRequiredStudiesString(),
            'idiomas'=> $offer->getRequiredLanguagesString(),
            'vacantes'=> $offer->getPositionNo(),
            'jornada'=> $offer->getWorkday(),
            'requisitos'=> $offer->getOtherKnowledges(),
            'perfil'=>   $offer->getObservations());

        $statement = $em->getConnection()->prepare($sql);
        $statement->execute($params);
        $id = $em->getConnection()->lastInsertId();

        $em->remove($offer);
        $em->flush();
      // return $this->forward('CuatrovientosArteanBundle:Offer:index');
        return $this->redirect('https://artean.cuatrovientos.org/?ap_manage_tbsolicitudes&ta=update&id='.$id);
    }

    
    /**
    * publish offer as
    *
    */
    public function newOfferPublishAction($id)
    {
        $offer = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:OfferOpen")->findOffer($id);
                
        $news = new News();
        $news->setTitle($offer->getCompany(). ' ' . $offer->getPosition());
        $news->setPermalink($this->get("cuatrovientos_artean.utils.permalink")->permalink($news->getTitle()));
        $news->setWhat(base64_encode($offer->getDescription()));
        $news->setNewsdate(time());
        $news->setWho(1);
        $news->setStatus(1);

        
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($news);
        $offer->setPublished(1);
        $em->persist($offer);
        
        $em->flush();

        $form = $this->createForm(NewsType::class, $news);
        return $this->render('CuatrovientosArteanBundle:News:update.html.twig',array('form'=> $form->createView(),'id'=>$news->getId()));

        return $response;
    }
}
