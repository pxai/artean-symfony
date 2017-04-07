<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Company;
use Cuatrovientos\ArteanBundle\Form\Type\CompanySearchType;
use Cuatrovientos\ArteanBundle\Form\Type\CompanyType;


class CompanyController extends Controller
{
    /**
    *
    *
    */
    public function indexAction($init=0,$limit=100)
    {
        $form = $this->createForm(CompanySearchType::class);
        $companies = $this->get("cuatrovientos_artean.bo.company")->findAllCompanies(0, $init, $limit);
        $total = $this->get("cuatrovientos_artean.bo.company")->countAllCompanies();
        return $this->render('CuatrovientosArteanBundle:Company:index.html.twig', array('companies'=>$companies, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
    }


    public function searchAction(Request $request)
    {
        $form = $this->createForm(CompanySearchType::class, new Company());
        //$companies = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Company")->findAll();

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            //$form->submit($request->request->get($form->getName()));

            if ($form->isValid()) {
                $company = $form->getData();
                $init = 0;
                $limit = 100;
                $companies = $this->get("cuatrovientos_artean.bo.company")->searchCompanies($company, 0, 100);
                $total = count($companies);
                return $this->render('CuatrovientosArteanBundle:Company:index.html.twig', array('companies' => $companies, 'init' => $init, 'limit' => $limit, 'total' => $total, 'form' => $form->createView()));

            }
        } else {
            $companies = $this->get("cuatrovientos_artean.bo.company")->findAllCompanies(0, $init, $limit);
            $total = $this->get("cuatrovientos_artean.bo.company")->countAllCompanies();
            return $this->render('CuatrovientosArteanBundle:Company:index.html.twig', array('companies' => $companies, 'init' => $init, 'limit' => $limit, 'total' => $total, 'form' => $form->createView()));
        }
    }

    /**
    *
    *
    */
   public function newCompanyAction()
    {
        $form = $this->createForm(CompanyType::class);
        return $this->render('CuatrovientosArteanBundle:Company:new.html.twig', array('form'=> $form->createView()));
    }

    /**
    *
    *
    */
    public function newCompanySaveAction(Request $request)
    {
        //$form = $this->createForm(new CompanyType(), new Company());
        $form = $this->createForm(CompanyType::class, new Company());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            //$form->submit($request->request->get($form->getName()));
            
            if ($form->isValid()) {
                $company = $form->getData();
                
//                $em = $this->getDoctrine()->getEntityManager();
//                $em->merge($company);
//                $em->flush();

                $this->get("cuatrovientos_artean.bo.company")->create($company);

                $response =  $this->render('CuatrovientosArteanBundle:Company:newSave.html.twig', array('company' => $company));               
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Company:new.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }

    /**
    *
    *
    */
   public function companyDetailAction($id=1)
    {

        $company = $this->get("cuatrovientos_artean.bo.company")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Company:detail.html.twig',array('company'=> $company));
    }

    /**
    *
    *
    */
    public function companyUpdateAction($id) {
        $company = $this->get("cuatrovientos_artean.bo.company")->selectById($id);
      
        $form = $this->createForm(CompanyType::class, $company);

        return $this->render('CuatrovientosArteanBundle:Company:update.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }
    
    /**
    *
    *
    */
    public function companyUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(CompanyType::class, new Company());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $company = $form->getData();

                $this->get("cuatrovientos_artean.bo.company")->update($company);
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:Company:companyDetail', array('id' => $company->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:Company:updatePost.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    /**
    *
    *
    */
   public function companyDeleteAction($id)
    {
        $company = $this->get("cuatrovientos_artean.bo.company")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Company:delete.html.twig',array('company'=> $company));
    }

    /**
    *
    *
    */
   public function companyDeleteSaveAction(Company $company)
    {
        $this->get("cuatrovientos_artean.bo.company")->remove($company);
       return $this->forward('CuatrovientosArteanBundle:Company:index');
    }

}
