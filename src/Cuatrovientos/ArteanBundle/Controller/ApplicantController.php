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
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantStudiesType;

class ApplicantController extends Controller
{

    public function dashboardAction()
    {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($this->user->getId());
        $applicantStudies = new ApplicantStudies();
        $applicantStudies->setApplicant($applicant);
        $form = $this->createForm(ApplicantType::class, $applicant);
        $formStudies = $this->createForm(ApplicantStudiesType::class, $applicantStudies);
        return $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView(),'formStudies'=>$formStudies->createView(),'applicant'=>$applicant));
    }


    public function updateAction(Request $request) {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $logger = $this->get('logger');
        $form = $this->createForm(ApplicantType::class, new Applicant());
      //  $form->submit($request->request->get($form->getName()));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicant = $form->getData();
                $applicant->setIdUser($this->user->getId());
                $this->get("cuatrovientos_artean.bo.applicant")->update($applicant);

                return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    public function newStudiesAction(Request $request) {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $logger = $this->get('logger');
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($this->user->getId());
        $form = $this->createForm(ApplicantStudiesType::class, new ApplicantStudies());
        //  $form->submit($request->request->get($form->getName()));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicantStudies = $form->getData();
                $applicantStudies->setApplicant($applicant);
                $this->get("cuatrovientos_artean.bo.applicant")->saveApplicantStudies($applicantStudies);

                return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    public function deleteStudiesAction($id) {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($this->user->getId());
        $applicantStudies= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantStudies($id, $applicant);
        if (null !=  $applicantStudies) {
            $this->get("cuatrovientos_artean.bo.applicant")->deleteApplicantStudies($applicantStudies);
        }
        return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');

    }

    public function updateStudiesAction($id) {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($this->user->getId());
        $applicantStudies= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantStudies($id, $applicant);

        if (null !=  $applicantStudies) {
            $formStudies = $this->createForm(ApplicantStudiesType::class, $applicantStudies);
            return $this->render('CuatrovientosArteanBundle:Applicant/Studies:update.html.twig', array('formStudies' => $formStudies->createView()));
        } else {
            return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
        }
    }

    public function updateStudiesSaveAction(Request $request) {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $logger = $this->get('logger');
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($this->user->getId());
        $form = $this->createForm(ApplicantStudiesType::class, new ApplicantStudies());
        //  $form->submit($request->request->get($form->getName()));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicantStudies = $form->getData();
                $applicantStudies->setApplicant($applicant);
                $this->get("cuatrovientos_artean.bo.applicant")->updateApplicantStudies($applicantStudies);

                return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }
}
