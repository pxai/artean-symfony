<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Cuatrovientos\ArteanBundle\Form\Type\CompanySearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Mailing;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Entity\Company;
use Cuatrovientos\ArteanBundle\Form\Type\MailingType;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantAdvancedSearchType;

class MailingController extends Controller
{
    /**
    *
    *
    */
    public function indexAction($init=0,$limit=100) {
        $form = $this->createForm(MailingType::class);
        $mailings = $this->get("cuatrovientos_artean.bo.mailing")->findAllMailings(0, $init, $limit);
        $total = $this->get("cuatrovientos_artean.bo.mailing")->countAllMailings();
        return $this->render('CuatrovientosArteanBundle:Mailing:index.html.twig', array('mailings'=>$mailings, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
    }

    public function searchAction(Request $request)
    {
        $form = $this->createForm(MailingType::class, new Mailing());
        $init = 0;
        $limit = 100;

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $mailing = $form->getData();

                $mailings = $this->get("cuatrovientos_artean.bo.mailing")->searchMailings($mailing, 0, 100);
                $total = count($mailing);
                return $this->render('CuatrovientosArteanBundle:Mailing:index.html.twig', array('mailings' => $mailings, 'init' => $init, 'limit' => $limit, 'total' => $total, 'form' => $form->createView()));
            }
        } else {
            $mailings = $this->get("cuatrovientos_artean.bo.mailing")->findAllMailings(0, $init, $limit);
            $total = $this->get("cuatrovientos_artean.bo.mailing")->countAllMailings();
            return $this->render('CuatrovientosArteanBundle:Mailing:index.html.twig', array('mailings'=>$mailings, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
        }
    }

   public function newMailingAction()
    {
        $form = $this->createForm(MailingType::class);
        return $this->render('CuatrovientosArteanBundle:Mailing:new.html.twig', array('form'=> $form->createView()));
    }


    public function newMailingSaveAction(Request $request)
    {
        //$form = $this->createForm(new MailingType(), new Mailing());
        $form = $this->createForm(MailingType::class, new Mailing());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $mailing = $form->getData();
                $this->get("cuatrovientos_artean.bo.mailing")->create($mailing);
                $response =  $this->redirectToRoute("cuatrovientos_artean_mailing");
                //$response =  $this->render('CuatrovientosArteanBundle:Mailing:newSave.html.twig', array('mailing' => $mailing));
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Mailing:new.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }


   public function mailingDetailAction($id=1)
    {
        $form = $this->createForm(ApplicantAdvancedSearchType::class, new Applicant());
        $formCompany = $this->createForm(CompanySearchType::class, new Company());
        $mailing = $this->get("cuatrovientos_artean.bo.mailing")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Mailing:detail.html.twig',array('form'=>$form->createView(),'formCompany'=>$formCompany->createView(),'mailing'=> $mailing));
    }


    public function mailingUpdateAction($id) {
        $mailing = $this->get("cuatrovientos_artean.bo.mailing")->selectById($id);
        $form = $this->createForm(MailingType::class, $mailing);
        return $this->render('CuatrovientosArteanBundle:Mailing:update.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }
    

    public function mailingUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(MailingType::class, new Mailing());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $mailing = $form->getData();

                $this->get("cuatrovientos_artean.bo.mailing")->update($mailing);
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:Mailing:mailingDetail', array('id' => $mailing->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:Mailing:updatePost.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }


   public function mailingDeleteAction($id=1)
    {
        $mailing = $this->get("cuatrovientos_artean.bo.mailing")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Mailing:delete.html.twig',array('mailing'=> $mailing));
    }

   public function mailingDeleteSaveAction(Mailing $mailing)
    {
        $this->get("cuatrovientos_artean.bo.mailing")->remove($mailing);
       return $this->forward('CuatrovientosArteanBundle:Mailing:index');
    }

}
