<?php

namespace  Cuatrovientos\ArteanBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
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
}
