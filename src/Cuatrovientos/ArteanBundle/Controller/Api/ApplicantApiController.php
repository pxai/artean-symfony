<?php

namespace  Cuatrovientos\ArteanBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantAdvancedSearchType;

class ApplicantApiController extends Controller
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
    public function advancedSearchAction(Request $request) {
        $form = $this->createForm(ApplicantAdvancedSearchType::class, new Applicant());
        $response = "";
        $applicants = array();
        $total = 0;

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
           // if ($form->isValid()) {
                $applicant = $form->getData();
                return  $this->get("cuatrovientos_artean.bo.applicant")->searchApplicants($applicant,0,100);
                //$applicants = $this->get("cuatrovientos_artean.bo.applicant")->detailedSearchApplicants($applicant);
                //return $applicants;
            /*} else  {
                $applicants = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicants(0, 0, 10);
                $total = $this->get("cuatrovientos_artean.bo.applicant")->countAllApplicants();
                return $applicants;
            }*/
        }
        return $applicants;
    }
}
