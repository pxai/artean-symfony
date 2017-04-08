<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\ContractType;
use Cuatrovientos\ArteanBundle\Form\Type\ContractTypeType;

class ContractTypeController extends Controller
{
    /**
    *
    *
    */
    public function indexAction($init=0,$limit=100) {
        $form = $this->createForm(ContractTypeType::class);
        $contractTypes = $this->get("cuatrovientos_artean.bo.contracttype")->findAllContractTypes(0, $init, $limit);
        $total = $this->get("cuatrovientos_artean.bo.contracttype")->countAllContractTypes();
        return $this->render('CuatrovientosArteanBundle:ContractType:index.html.twig', array('contractTypes'=>$contractTypes, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
    }

    public function searchAction(Request $request)
    {
        $form = $this->createForm(ContractTypeType::class, new ContractType());
        $init = 0;
        $limit = 100;

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $contractType = $form->getData();

                $contractTypes = $this->get("cuatrovientos_artean.bo.contracttype")->searchContractTypes($contractType, 0, 100);
                $total = count($contractType);
                return $this->render('CuatrovientosArteanBundle:ContractType:index.html.twig', array('contractTypes' => $contractTypes, 'init' => $init, 'limit' => $limit, 'total' => $total, 'form' => $form->createView()));
            }
        } else {
            $contractTypes = $this->get("cuatrovientos_artean.bo.contracttype")->findAllContractTypes(0, $init, $limit);
            $total = $this->get("cuatrovientos_artean.bo.contracttype")->countAllContractTypes();
            return $this->render('CuatrovientosArteanBundle:ContractType:index.html.twig', array('contractTypes'=>$contractTypes, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
        }
    }

   public function newContractTypeAction()
    {
        $form = $this->createForm(ContractTypeType::class);
        return $this->render('CuatrovientosArteanBundle:ContractType:new.html.twig', array('form'=> $form->createView()));
    }


    public function newContractTypeSaveAction(Request $request)
    {
        //$form = $this->createForm(new ContractTypeType(), new ContractType());
        $form = $this->createForm(ContractTypeType::class, new ContractType());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $contractType = $form->getData();
                $this->get("cuatrovientos_artean.bo.contracttype")->create($contractType);
                $response =  $this->redirectToRoute("cuatrovientos_artean_contracttype");
                //$response =  $this->render('CuatrovientosArteanBundle:ContractType:newSave.html.twig', array('contractType' => $contractType));
            } else {
                $response = $this->render('CuatrovientosArteanBundle:ContractType:new.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }


   public function contracttypeDetailAction($id=1)
    {
        $contractType = $this->get("cuatrovientos_artean.bo.contracttype")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:ContractType:detail.html.twig',array('contractType'=> $contractType));
    }


    public function contracttypeUpdateAction($id) {
        $contractType = $this->get("cuatrovientos_artean.bo.contracttype")->selectById($id);
        $form = $this->createForm(ContractTypeType::class, $contractType);
        return $this->render('CuatrovientosArteanBundle:ContractType:update.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }
    

    public function contracttypeUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(ContractTypeType::class, new ContractType());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $contractType = $form->getData();

                $this->get("cuatrovientos_artean.bo.contracttype")->update($contractType);
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:ContractType:contracttypeDetail', array('id' => $contractType->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:ContractType:updatePost.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }


   public function contracttypeDeleteAction($id=1)
    {
        $contractType = $this->get("cuatrovientos_artean.bo.contracttype")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:ContractType:delete.html.twig',array('contractType'=> $contractType));
    }

   public function contracttypeDeleteSaveAction(ContractType $contractType)
    {
        $this->get("cuatrovientos_artean.bo.contracttype")->remove($contractType);
       return $this->forward('CuatrovientosArteanBundle:ContractType:index');
    }

}
