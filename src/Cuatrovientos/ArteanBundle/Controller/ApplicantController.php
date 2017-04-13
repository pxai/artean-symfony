<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Entity\User;
use Cuatrovientos\ArteanBundle\Entity\Session;
use Cuatrovientos\ArteanBundle\Entity\UserRole;
use Cuatrovientos\ArteanBundle\Entity\ApplicantStudies;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantType;
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

    public function dashboardAction()
    {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($this->user->getId());
        $form = $this->createForm(ApplicantType::class, $applicant);
        return $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
    }




    /**
    *
    *
    */
    public function updateAction(Request $request) {
      
        $form = $this->createForm(ApplicantType::class, new Applicant());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicant = $form->getData();

                $this->get("cuatrovientos_artean.bo.applicant")->update($applicant);

                return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }



}
