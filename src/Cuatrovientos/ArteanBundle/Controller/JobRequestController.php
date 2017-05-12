<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Cuatrovientos\ArteanBundle\Entity\JobRequestPreselected;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\JobRequest;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Form\Type\JobRequestSearchType;
use Cuatrovientos\ArteanBundle\Form\Type\JobRequestType;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantAdvancedSearchType;
use Cuatrovientos\ArteanBundle\Form\Type\JobRequestPreselectedType;

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
        $init = 0;
        $limit = 100;

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


    public function addPreselectedAction(Request $request)
    {
        $form = $this->createForm(JobRequestPreselectedType::class, new JobRequest());
        $jobRequest ="";

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $jobRequest = $form->getData();

               //$this->get('logger')->info('Here we go with real data: ' . $serializer->serialize($form->getData(), 'json'));
                $this->get("cuatrovientos_artean.bo.jobrequest")->update($jobRequest);
                return $this->jobrequestDetailAction($jobRequest->getId());
            } else {
                return $this->jobrequestDetailAction($jobRequest->getId());
            }
        }
        return $this->jobrequestDetailAction($jobRequest->getId());
    }

   public function addSelectedSaveAction($jobrequestid, $applicantid) {
       $result  = $this->get("cuatrovientos_artean.bo.jobrequest")->addSelected($jobrequestid, $applicantid);

       if ($result) {
           $applicant = $this->get("cuatrovientos_artean.bo.applicant")->selectById($applicantid);
           $jobrequest = $this->get("cuatrovientos_artean.bo.jobrequest")->selectById($jobrequestid);

           $response = $this->render('CuatrovientosArteanBundle:JobRequest:selected.html.twig', array('jobrequest'=>"$jobrequest",applicant =>$applicant));
       } else {
           $response = new Response(json_encode(array('result' => $result)));
           $response->headers->set('Content-Type', 'application/json');
       }

       return $response;
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
        $form = $this->createForm(ApplicantAdvancedSearchType::class, new Applicant());
        $formPreselected = $this->createForm(JobRequestPreselectedType::class);
        $jobRequest = $this->get("cuatrovientos_artean.bo.jobrequest")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:JobRequest:detail.html.twig',array('jobRequest'=> $jobRequest, 'form'=>$form->createView(), 'formPreselected'=>$formPreselected->createView()));
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
