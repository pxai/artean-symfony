<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\JobRequest;
use Cuatrovientos\ArteanBundle\Form\Type\JobRequestSearchType;
use Cuatrovientos\ArteanBundle\Form\Type\JobRequestType;


class JobRequestController extends Controller
{

    public function indexAction($init=0,$limit=100)
    {
        $form = $this->createForm(JobRequestSearchType::class);
        $jobRequests = $this->get("cuatrovientos_artean.bo.jobrequest")->findAllJobRequests(0, $init, $limit);
        $total = $this->get("cuatrovientos_artean.bo.jobrequest")->countAllJobRequests();
        return $this->render('CuatrovientosArteanBundle:JobRequest:index.html.twig', array('jobRequests'=>$jobRequests, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
    }


    public function searchAction(Request $request)
    {
        $form = $this->createForm(JobRequestSearchType::class, new JobRequest());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $jobRequest = $form->getData();
                $init = 0;
                $limit = 100;
                $jobRequests = $this->get("cuatrovientos_artean.bo.jobrequest")->searchJobRequests($jobRequest, 0, 100);
                $total = count($jobRequests);
                return $this->render('CuatrovientosArteanBundle:JobRequest:index.html.twig', array('jobRequests' => $jobRequests, 'init' => $init, 'limit' => $limit, 'total' => $total, 'form' => $form->createView()));

            }
        } else {
            $jobRequests = $this->get("cuatrovientos_artean.bo.jobrequest")->findAllJobRequests(0, $init, $limit);
            $total = $this->get("cuatrovientos_artean.bo.jobrequest")->countAllJobRequests();
            return $this->render('CuatrovientosArteanBundle:JobRequest:index.html.twig', array('jobRequests' => $jobRequests, 'init' => $init, 'limit' => $limit, 'total' => $total, 'form' => $form->createView()));
        }
    }


   public function newJobRequestAction()
    {
        $form = $this->createForm(JobRequestType::class, new JobRequest());
        return $this->render('CuatrovientosArteanBundle:JobRequest:new.html.twig', array('form'=> $form->createView()));
    }

    public function newJobRequestSaveAction(Request $request)
    {
        $form = $this->createForm(JobRequestType::class, new JobRequest());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            if ($form->isValid()) {
                $jobRequest = $form->getData();

                $this->get("cuatrovientos_artean.bo.jobrequest")->create($jobRequest);

                return $this->forward('CuatrovientosArteanBundle:JobRequest:index');
            } else {
                $response = $this->render('CuatrovientosArteanBundle:JobRequest:new.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }


   public function jobrequestDetailAction($id=1)
    {

        $jobReques = $this->get("cuatrovientos_artean.bo.jobrequest")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:JobRequest:detail.html.twig',array('jobRequest'=> $jobReques));
    }


    public function jobrequestUpdateAction($id) {
        $jobRequest = $this->get("cuatrovientos_artean.bo.jobrequest")->selectById($id);
      
        $form = $this->createForm(JobRequestType::class, $jobRequest);

        return $this->render('CuatrovientosArteanBundle:JobRequest:update.html.twig',array('form'=> $form->createView(),'jobRequest'=>$jobRequest,'id'=>$id));
    }
    

    public function jobrequestUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(JobRequestType::class, new JobRequest());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $jobReques = $form->getData();

                $this->get("cuatrovientos_artean.bo.jobrequest")->update($jobReques);
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:JobRequest:jobrequestDetail', array('id' => $jobReques->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:JobRequest:updatePost.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }


   public function jobrequestDeleteAction($id)
    {
        $jobRequest = $this->get("cuatrovientos_artean.bo.jobrequest")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:JobRequest:delete.html.twig',array('jobRequest'=> $jobRequest));
    }


   public function jobrequestDeleteSaveAction(JobRequest $jobRequest)
    {
        $this->get("cuatrovientos_artean.bo.jobrequest")->remove($jobRequest);
       return $this->forward('CuatrovientosArteanBundle:JobRequest:index');
    }

}
