<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Entity\User;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantSignInType;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantSignUpType;

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
                $new_applicant = $form->getData();
                $applicant = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Applicant")->findApplicant($new_applicant->getEmail());
                $user = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:User")->findUser($new_applicant->getEmail());
                
                if (null != $applicant || null != $user) {
                    $response =  $this->render('CuatrovientosArteanBundle:Applicant:signInSave.html.twig', array('email' => $new_applicant->getEmail(),'msg'=>'Ya existe'));                               
                } else {
                    $form = $this->createForm(ApplicantSignUpType::class, $new_applicant);
                    $response = $this->render('CuatrovientosArteanBundle:Applicant:signUp.html.twig', array('form'=> $form->createView()));
                }
               /* $em = $this->getDoctrine()->getEntityManager();
                $em->merge($applicant);
                $em->flush();
                $this->sendEmail($applicant);*/
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:signIn.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }

    
     public function applicantSignUpSaveAction(Request $request)
    {
        //$form = $this->createForm(new ApplicantType(), new Applicant());
        //$request->get('position')->set($request->request->get('company') .', '. $request->request->get('position'));    
        $form = $this->createForm(ApplicantSignUpType::class, new Applicant());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            //$form->submit($request->request->get($form->getName()));
            
            if ($form->isValid()) {
                $applicant = $form->getData();
                $user = new User();
                
                $user->setFullname($applicant->getName() .' '.$applicant->getSurname());
                $user->setLogin($applicant->getEmail());
                $user->setEmail($applicant->getEmail());
                $user->setPassword($user->randPassword());
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($user);
                $em->flush();
                
                $applicant->setIdUser($user->getId());
                
                $em->merge($applicant);
                $em->flush();
                $this->sendEmail($applicant);
                $this->sendEmailUser($user);
                
                $response = $this->render('CuatrovientosArteanBundle:Applicant:signUpSave.html.twig', array('applicant'=> $applicant));
                
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:signIn.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }
    
    private function sendEmail ($applicant) {
         $message = \Swift_Message::newInstance()
        ->setSubject('Artean: ¡nuevo candidato en la bolsa de empleo!')
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

        $this->get('mailer')->send($message);

    }
    
    
        private function sendEmailUser ($user) {
         $message = \Swift_Message::newInstance()
        ->setSubject('Artean: ¡Bienvvenid@ la bolsa de empleo!')
        ->setFrom('artean@cuatrovientos.org')
        ->setTo($user->getEmail())
        ->setBcc('pello_altadill@cuatrovientos.org')
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'Emails/newUser.html.twig',
                array('user' => $user)
            ),
            'text/html'
        );

        $this->get('mailer')->send($message);

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
