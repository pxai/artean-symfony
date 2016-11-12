<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\OfferAdOpen;
use Cuatrovientos\ArteanBundle\Form\Type\OfferAdType;
use Cuatrovientos\ArteanBundle\Entity\News;

class OfferAdController extends Controller
{
    /**
    *
    *
    */
    public function indexAction()
    {
        return $this->newOfferAdOpenAction();
    }  
    
    /**
    *
    *
    */
   public function newOfferAdOpenAction()
    {
        $form = $this->createForm(OfferAdType::class);
        return $this->render('CuatrovientosArteanBundle:OfferAd:newAdOpen.html.twig', array('form'=> $form->createView()));
    }

    /**
    *
    *
    */
    public function newOfferAdSaveOpenAction(Request $request)
    {
        //$form = $this->createForm(new OfferType(), new Offer());
        //$request->get('position')->set($request->request->get('company') .', '. $request->request->get('position'));    
        $form = $this->createForm(OfferAdType::class, new OfferAdOpen());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            //$form->submit($request->request->get($form->getName()));
            
            if ($form->isValid()) {
                $offer = $form->getData();

                $newsContent = '<p>'.$offer->getDescription() .'</p>';
                $newsContent .= '<div><b>Localidad</b><p>'.$offer->getLocation() .'</p></div>';
                $newsContent .= '<div><b>Vacantes</b><p>'.$offer->getPositionNo() .'</p></div>';
                $newsContent .= '<div><b>Jornada</b><p>'.$offer->getWorkday() .'</p></div>';
                $newsContent .= '<div><b>Estudios</b><p>'.$offer->getRequiredStudiesString() .'</p></div>';
                $newsContent .= '<div><b>Otros conocimientos</b><p>'.$offer->getOtherKnowledges() .'</p></div>';
                $newsContent .= '<div><b>Observaciones</b><p>'.$offer->getObservations() .'</p></div>';
                $newsContent .= '<div><b>Contacto</b><p>'.$offer->getContact() .'</p></div>';

                $news = new News();
                $news->setTitle($offer->getCompany(). ' ' . $offer->getPosition());
                $news->setPermalink($this->permalink($news->getTitle()));
                $news->setWhat(base64_encode($newsContent));
                $news->setTags($offer->getRequiredStudiesString());
                $news->setNewsdate(time());
                $news->setWho(1);
                $news->setStatus(0);
            
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($news);
                $em->flush();
                $this->sendEmail($offer);
                $response =  $this->render('CuatrovientosArteanBundle:OfferAd:newAdSave.html.twig', array('offer' => $offer));               
            } else {
                $response = $this->render('CuatrovientosArteanBundle:OfferAd:newAdOpen.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }

    private function sendEmail ($offer) {
         $message = \Swift_Message::newInstance()
        ->setSubject('Artean: ¡nuevo anuncio de oferta de empleo publicado por empresa!')
        ->setFrom('artean@cuatrovientos.org')
        ->setTo('artean@cuatrovientos.org')
        ->setBcc('pello_altadill@cuatrovientos.org')
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/newOfferAd.html.twig
                'Emails/newOfferAd.html.twig',
                array('offer' => $offer)
            ),
            'text/html'
        );
        /*
         * If you also want to include a plaintext version of the message
        ->addPart(
            $this->renderView(
                'Emails/registration.txt.twig',
                array('name' => $name)
            ),
            'text/plain'
        )
        */
        $this->get('mailer')->send($message);

        //return $this->render(...);
    }
    
    private function permalink ($title) {
        $url = '';
        $patterns = array("/\s+/");
        $subst = array("-");
        $url = preg_replace($patterns, $subst, $title);
        return strtolower($url);
    }
   
}
