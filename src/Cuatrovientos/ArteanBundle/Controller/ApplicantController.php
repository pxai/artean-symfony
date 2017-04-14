<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Entity\ApplicantStudies;
use Cuatrovientos\ArteanBundle\Entity\ApplicantLanguages;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantType;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantStudiesType;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantLanguageType;

class ApplicantController extends Controller
{

    public function dashboardAction()
    {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($this->user->getId());
       /* $applicantStudies = new ApplicantStudies();
        $applicantStudies->setApplicant($applicant);

        $applicantLanguages = new ApplicantLanguages();
        $applicantLanguages->setApplicant($applicant);*/

        $form = $this->createForm(ApplicantType::class, $applicant);
        $formStudies = $this->createForm(ApplicantStudiesType::class, new ApplicantStudies());
        $formLanguage = $this->createForm(ApplicantLanguageType::class, new ApplicantLanguages());
        return $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig',
            array(  'form'=> $form->createView(),
                    'formStudies'=>$formStudies->createView(),
                    'formLanguage'=>$formLanguage->createView(),
                    'applicant'=>$applicant));
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

        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($this->user->getId());
        $form = $this->createForm(ApplicantStudiesType::class, new ApplicantStudies());

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

    public function newLanguageAction(Request $request) {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();

        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($this->user->getId());
        $form = $this->createForm(ApplicantLanguageType::class, new ApplicantLanguages());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicantLanguages = $form->getData();
                $applicantLanguages->setApplicant($applicant);
                $this->get("cuatrovientos_artean.bo.applicant")->saveApplicantLanguages($applicantLanguages);

                return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    public function updateLanguageAction($id) {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($this->user->getId());
        $applicantLanguages= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantLanguages($id, $applicant);

        if (null !=  $applicantLanguages) {
            $formLanguage = $this->createForm(ApplicantLanguageType::class, $applicantLanguages);
            return $this->render('CuatrovientosArteanBundle:Applicant/Languages:update.html.twig', array('formLanguage' => $formLanguage->createView()));
        } else {
            return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
        }
    }

    public function updateLanguageSaveAction(Request $request) {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();

        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($this->user->getId());
        $form = $this->createForm(ApplicantLanguageType::class, new ApplicantLanguages());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicantLanguages = $form->getData();
                $applicantLanguages->setApplicant($applicant);
                $this->get("cuatrovientos_artean.bo.applicant")->updateApplicantLanguages($applicantLanguages);

                return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    public function deleteLanguageAction($id) {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($this->user->getId());
        $applicantLanguages= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantLanguages($id, $applicant);
        if (null !=  $applicantLanguages) {
            $this->get("cuatrovientos_artean.bo.applicant")->deleteApplicantLanguages($applicantLanguages);
        }
        return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
    }
}
