<?php

namespace  Cuatrovientos\ArteanBundle\Controller\Api;

use Cuatrovientos\ArteanBundle\Form\Type\JobRequestSelectedType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Entity\MailingJobRequest;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantType;

class MailingApiController extends Controller
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
    public function deleteSelectedApplicantSaveAction($mailingid, $applicantid) {
        $result = $this->get("cuatrovientos_artean.bo.mailing")->deleteSelectedApplicant($mailingid, $applicantid);
        return '{"mailingid":'.$mailingid.',"result":'.$result.'}';
    }


}
