<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query\ResultSetMapping;
use Cuatrovientos\ArteanBundle\Entity\Offer;
use Cuatrovientos\ArteanBundle\Entity\News;
use Cuatrovientos\ArteanBundle\Entity\OfferAdOpen;
use Cuatrovientos\ArteanBundle\Form\Type\OfferAdType;
use Cuatrovientos\ArteanBundle\Form\Type\NewsType;

class OfferAdController extends Controller
{

    public function indexAction()
    {

        $offers = $this->get("cuatrovientos_artean.bo.offerad")->findAllOfferAds();
        return $this->render('CuatrovientosArteanBundle:OfferAd:index.html.twig' , array('offers'=>$offers));
    }

    public function indexStatusAction($status)
    {

        $offers = $this->get("cuatrovientos_artean.bo.offerad")->findAllOfferAdsByStatus($status);
        return $this->render('CuatrovientosArteanBundle:OfferAd:index.html.twig' , array('offers'=>$offers));
    }

    public function newOfferAdOpenAction()
    {
        $form = $this->createForm(OfferAdType::class);
        return $this->render('CuatrovientosArteanBundle:OfferAd:new.html.twig' , array('form'=> $form->createView()));
    }


    public function newOfferAdSaveOpenAction(Request $request)
    {
        //$form = $this->createForm(new OfferType(), new Offer());
        //$request->get('position')->set($request->request->get('company') .'=> , '. $request->request->get('position'));    
        $form = $this->createForm(OfferAdType::class, new OfferAdOpen());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            //$form->submit($request->request->get($form->getName()));
            
            if ($form->isValid()) {
                $offer = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($offer);
                $em->flush();
                $this->sendEmail($offer);
                $response =  $this->render('CuatrovientosArteanBundle:OfferAd:newSave.html.twig' , array('offer' => $offer));
            } else {
                $response = $this->render('CuatrovientosArteanBundle:OfferAd:newOpen.html.twig' , array('form'=> $form->createView()));
            }
        }

        return $response;
    }

    private function sendEmail ($offer) {
         $message = \Swift_Message::newInstance()
        ->setSubject('Artean: ¡nueva PUBLICACIÓN DE OFERTA de empleo!')
        ->setFrom('artean@cuatrovientos.org')
        ->setTo('artean@cuatrovientos.org')
        ->setBcc('pello_altadill@cuatrovientos.org')
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'Emails/newOfferAd.html.twig' ,
                array('offer' => $offer)
            ),
            'text/html'
        );

        $this->get('mailer')->send($message);

    }


   public function offerAdDetailAction($id=1)
    {

        $offer = $this->get("cuatrovientos_artean.bo.offerad")->selectById($id);
   
        return $this->render('CuatrovientosArteanBundle:OfferAd:offer.html.twig' ,array('offer'=> $offer));
    }


    public function offerAdUpdateAction($id) {
        $offer = $this->get("cuatrovientos_artean.bo.offerad")->selectById($id);
      
        $form = $this->createForm(OfferAdType::class, $offer);

        return $this->render('CuatrovientosArteanBundle:OfferAd:update.html.twig' ,array('form'=> $form->createView(),'id'=>$id));
    }
    

    public function offerAdUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(OfferAdType::class, new OfferAdOpen());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $offer = $form->getData();

                $this->get("cuatrovientos_artean.bo.offerad")->update($offer);
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:OfferAd:offerAdDetail' , array('id' => $offer->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:OfferAd:updatePost.html.twig' , array('form'=> $form->createView()));
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
        $offer = $this->get("cuatrovientos_artean.bo.offerad")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:OfferAd:delete.html.twig' ,array('offer'=> $offer));
    }

    /**
    *
    *
    */
   public function offerDeleteSaveAction(OfferAdOpen $offer)
    {
        $this->get("cuatrovientos_artean.bo.offerad")->remove($offer);
      // return $this->forward('CuatrovientosArteanBundle:Offer:index');
        return $this->redirectToRoute('cuatrovientos_artean_offerad');
    }


    public function offerProcessSaveAction(OfferOpen $offer)
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
        $offer->setPublished(5);
        $em->persist($offer);
        $em->flush();
        // return $this->forward('CuatrovientosArteanBundle:OfferAd:index');
        return $this->redirect('https://artean.cuatrovientos.org/?ap_manage_tbsolicitudes&ta=update&id='.$id);
    }

    
    /**
    * publish offer as
    *
    */
    public function newOfferAdPublishAction($id)
    {
        $offer = $this->get("cuatrovientos_artean.bo.offerad")->selectById($id);
                
        $news = new News();
        $news->setTitle($offer->getCompany(). ' ' . $offer->getPosition());
        $news->setPermalink($this->get("cuatrovientos_artean.utils.permalink")->permalink($news->getTitle()));
        $news->setWhat(base64_encode($offer->getDescription()));
        $news->setNewsdate(time());
        $news->setWho(1);
        $news->setStatus(1);

        
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($news);
        $offer->setPublished(6);
        $em->persist($offer);
        
        $em->flush();

        $form = $this->createForm(NewsType::class, $news);
        return $this->render('CuatrovientosArteanBundle:News:update.html.twig',array('form'=> $form->createView(),'id'=>$news->getId()));

        return $response;
    }
}
