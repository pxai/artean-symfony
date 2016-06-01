<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantSignInType;

class ApplicantController extends Controller
{
    /**
    *
    *
    */
    public function indexAction()
    {
        //$applicants = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Applicant")->findAll();
        //$applicants = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Applicant")->findApplicant();
        $form = $this->createForm(ApplicantSignInType::class);
        return $this->render('CuatrovientosArteanBundle:Applicant:signIn.html.twig', array('form'=> $form->createView()));
    }  
    
    /**
    *
    *
    */
   public function applicantSignInAction()
    {
        $form = $this->createForm(ApplicantSignInType::class);
        return $this->render('CuatrovientosArteanBundle:Applicant:signIn.html.twig', array('form'=> $form->createView()));
    }

    /**
    *
    *
    */
    public function applicantSignInSaveAction(Request $request)
    {
        //$form = $this->createForm(new ApplicantType(), new Applicant());
        //$request->get('position')->set($request->request->get('company') .', '. $request->request->get('position'));    
        $form = $this->createForm(ApplicantSignInType::class, new Applicant());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            //$form->submit($request->request->get($form->getName()));
            
            if ($form->isValid()) {
                $applicant = $form->getData();
               /* $em = $this->getDoctrine()->getEntityManager();
                $em->merge($applicant);
                $em->flush();
                $this->sendEmail($applicant);*/
                $response =  $this->render('CuatrovientosArteanBundle:Applicant:signInSave.html.twig', array('applicant' => $applicant));               
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:signIn.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }

    private function sendEmail ($applicant) {
         $message = \Swift_Message::newInstance()
        ->setSubject('Artean: ¡nueva oferta de empleo!')
        ->setFrom('artean@cuatrovientos.org')
        ->setTo('artean@cuatrovientos.org')
        ->setBcc('pello_altadill@cuatrovientos.org')
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'Emails/newApplicant.html.twig',
                array('applicant' => $applicant)
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
    /**
    *
    *
    */
   public function applicantDetailAction($id=1)
    {

        $applicant = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Applicant")->find($id);
   
        return $this->render('CuatrovientosArteanBundle:Applicant:detail.html.twig',array('applicant'=> $applicant));
    }

    /**
    *
    *
    */
    public function applicantUpdateAction($id) {
        $applicant = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Applicant")->find($id);
      
        $form = $this->createForm(ApplicantType::class, $applicant);

        return $this->render('CuatrovientosArteanBundle:Applicant:update.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }
    
    /**
    *
    *
    */
    public function applicantUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(ApplicantType::class, new Applicant());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicant = $form->getData();
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($applicant);
                $em->flush();
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:Applicant:applicantDetail', array('id' => $applicant->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:Applicant:updatePost.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    /**
    *
    *
    */
   public function applicantDeleteAction($id=1)
    {
        $applicant = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Applicant")->find($id);
        return $this->render('CuatrovientosArteanBundle:Applicant:delete.html.twig',array('applicant'=> $applicant));
    }

    /**
    *
    *
    */
   public function applicantDeleteSaveAction(Applicant $applicant)
    {

       $em = $this->getDoctrine()->getEntityManager();
       $em->remove($applicant);
       $em->flush();
       return $this->forward('CuatrovientosArteanBundle:Applicant:index');
    }

}
