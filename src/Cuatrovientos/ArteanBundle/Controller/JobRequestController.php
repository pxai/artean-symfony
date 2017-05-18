<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Cuatrovientos\ArteanBundle\Entity\JobRequestPreselected;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\JobRequest;
use Cuatrovientos\ArteanBundle\Entity\JobRequestMail;
use Cuatrovientos\ArteanBundle\Entity\JobRequestStatus;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Form\Type\JobRequestSearchType;
use Cuatrovientos\ArteanBundle\Form\Type\JobRequestType;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantAdvancedSearchType;
use Cuatrovientos\ArteanBundle\Form\Type\JobRequestPreselectedType;
use Cuatrovientos\ArteanBundle\Form\Type\JobRequestMailType;

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
                $jb = $form->getData();
                $jobRequest = $this->get("cuatrovientos_artean.bo.jobrequest")->selectById($jb->getId());
                $jobRequest->setStatus(jobRequestStatus::PRESELECTED);
                $jobRequest->setPreselectedApplicants($jb->getPreselectedApplicants());

                $this->get("cuatrovientos_artean.bo.jobrequest")->updateApplicantSelection($jobRequest);
                return $this->jobrequestDetailAction($jobRequest->getId());
            } else {
                return $this->jobrequestDetailAction($jobRequest->getId());
            }
        }
        return $this->jobrequestDetailAction($jobRequest->getId());
    }

   public function addSelectedSaveAction($jobrequestid, $applicantid) {
       $result  = $this->get("cuatrovientos_artean.bo.jobrequest")->addSelected($jobrequestid, $applicantid);

       if ($result==1) {
           $applicant = $this->get("cuatrovientos_artean.bo.applicant")->selectById($applicantid);
           $jobrequest = $this->get("cuatrovientos_artean.bo.jobrequest")->selectById($jobrequestid);

           $response = $this->render('CuatrovientosArteanBundle:JobRequest:selected.html.twig', array('jobRequest'=> $jobrequest,'applicant' =>$applicant));
       } else {
           $response = new Response(json_encode(array('result' => $result)));
           $response->headers->set('Content-Type', 'application/json');
       }

       return $response;
    }

    public function addAllSelectedSaveAction($jobrequestid) {
        $result  = $this->get("cuatrovientos_artean.bo.jobrequest")->addAllSelected($jobrequestid);
        return $this->jobrequestDetailAction($jobrequestid);
    }

    public function deleteAllPreselectedSaveAction($id) {
        $result  = $this->get("cuatrovientos_artean.bo.jobrequest")->deleteAllPreselected($id);
        return $this->jobrequestDetailAction($id);
    }

    public function deleteAllSelectedSaveAction($id) {
        $result  = $this->get("cuatrovientos_artean.bo.jobrequest")->deleteAllSelected($id);
        return $this->jobrequestDetailAction($id);
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
        $jobRequestMail = new JobRequestMail();
        $jobRequest = $this->get("cuatrovientos_artean.bo.jobrequest")->selectById($id);
        if (count($jobRequest->getSelectedApplicants()) > 0) {
            $jobRequestMail = $this->prepareEmailContent($jobRequest);
        }
        $formEmail = $this->createForm(JobRequestMailType::class,$jobRequestMail);
        return $this->render('CuatrovientosArteanBundle:JobRequest:detail.html.twig',array('jobRequest'=> $jobRequest, 'form'=>$form->createView(), 'formEmail'=>$formEmail->createView(), 'formPreselected'=>$formPreselected->createView()));
    }


    public function jobrequestUpdateAction($id) {
        $jobRequest = $this->get("cuatrovientos_artean.bo.jobrequest")->selectById($id);
      
        $form = $this->createForm(JobRequestType::class, $jobRequest);

        return $this->render('CuatrovientosArteanBundle:JobRequest:update.html.twig',array('form'=> $form->createView(),'jobRequest'=>$jobRequest,'id'=>$id));
    }
    

    public function jobrequestUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(JobRequestType::class, new JobRequest());
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


    public function sendEmailAction(Request $request)
    {
        $jobRequestMail = 0;
        $form = $this->createForm(JobRequestMailType::class, new JobRequestMail());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $jobRequestMail = $form->getData();
                $jobRequestMail->encodeContent();

                $this->sendEmail($jobRequestMail);
                $this->get("cuatrovientos_artean.bo.jobrequest")->changeStatus($jobRequestMail->getId(),JobRequestStatus::MAIL_SENT);
                $request->getSession()->getFlashBag()->add('success', 'El email ha sido enviado.');
                return $this->jobrequestDetailAction($jobRequestMail->getId());
            } else {
                return $this->indexAction();
            }
        }

        return $this->indexAction();
    }

    private function sendEmail ($jobRequestMail) {
        $jobRequestMail->decodeContent();
        $message = \Swift_Message::newInstance()
            ->setSubject($jobRequestMail->getSubject())
            ->setFrom($jobRequestMail->getFrom())
            ->setTo($jobRequestMail->getTo())
            ->setBcc($jobRequestMail->getBcc())
            ->setBody($this->renderView(
                'Emails/jobRequest.html.twig',
                array('content' => $jobRequestMail->getContent())
            ),'text/html'

            );

        $this->get('mailer')->send($message);
    }

    private function  prepareEmailContent   ($jobRequest){
        $jobRequestMail = new JobRequestMail();
        $jobRequestMail->setId($jobRequest->getId());
        $jobRequestMail->setSubject('Candidaturas para la oferta: ' . $jobRequest->getDescription());
        $jobRequestMail->setTo($jobRequest->getCompany()->getEmail());

        $content = 'Estimado/a ' . $jobRequest->getAtt().'<br>';
        $content .= 'Estas son las candidaturas que hemos considerado para su puesto:<br><br>';

        foreach ($jobRequest->getSelectedApplicants() as $applicants) {
            $content .= $applicants->getName() .' '.$applicants->getSurname().'<br>';
            if ($applicants->getMobile()!="") {
                $content .= $applicants->getMobile() .' '.$applicants->getPhone().'<br>';
            }
            if ($applicants->getEmail()!="") {
                $content .= $applicants->getEmail() . '<br><br>';
            }
            $content .= '<br>';
        }

        $content .= 'Reciban un saludo desde Artean\n artean@cuatrovientos.org<br>';
        $jobRequestMail->setContent($content);
        return $jobRequestMail;
    }

}
