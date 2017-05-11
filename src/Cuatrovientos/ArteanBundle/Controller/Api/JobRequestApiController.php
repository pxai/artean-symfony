<?php

namespace  Cuatrovientos\ArteanBundle\Controller\Api;

use Cuatrovientos\ArteanBundle\Form\Type\JobRequestSelectedType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Entity\JobRequest;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantType;

class JobRequestApiController extends Controller
{
    /**
     * @Rest\View
     */
    public function indexAction(Request $request)
    {
        $applicants = $this->get("cuatrovientos_artean.bo.applicant")->findApplicants($request->query->get('term'));
        foreach ($applicants as $applicant) {
         $applicant->setName($applicant->getSurname().', ' .$applicant->getName());
        }
        return  $applicants;
    }

    /**
     * @Rest\View
     */
    public function deletePreselectedSaveAction($jobrequestid, $applicantid) {
        $logger = $this->get('logger');
        $logger->info('I just got the logger');
        $result = $this->get("cuatrovientos_artean.bo.jobrequest")->deletePreselected($jobrequestid, $applicantid);
        return "{'requestid':'".$jobrequestid."','result':'".$result."'}";
    }

    /*
    * @Method({"PUT"})
    * @Rest\View(statusCode=204)
    */
   public function addSelectedSaveAction(Request $request)
{
    $statusCode = 201;
    $this->get('logger')->info($request);
    $form = $this->createForm(JobRequestSelectedType::class, new JobRequest(),array('method' => 'PUT'));
    $form->handleRequest($request);
    $serializer = $this->get('jms_serializer');
    $this->get('logger')->info('Here we go with update.' . $serializer->serialize($form->getData(), 'json'));
    var_dump($request->request->all());

    if ($form->isValid()) {
        $jobrequest = $form->getData();
        $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($jobrequest, 'json'));

        $this->get("cuatrovientos_artean.bo.jobrequest")->update($jobrequest);


        $response = new Response();
        $response->setStatusCode($statusCode);

        // return $response;
        return View::create($jobrequest, $statusCode);
    } else {
        $this->get('logger')->info('Form is not valid: ');
    }

    return View::create($form, 400);

}
    /**
     * Rest\View
     */
   /* public function addSelectedSaveAction($jobrequestid, $applicantid) {
        $logger = $this->get('logger');
        $logger->info('I just got the logger');
        $result = $this->get("cuatrovientos_artean.bo.jobrequest")->addSelected($jobrequestid, $applicantid);
        return "{'requestid':'".$jobrequestid."','result':'".$result."'}";
    }*/
}
