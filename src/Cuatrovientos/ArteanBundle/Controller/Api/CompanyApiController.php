<?php

namespace  Cuatrovientos\ArteanBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

class CompanyApiController extends Controller
{
    /**
     * @Rest\View
     */
    public function indexAction(Request $request)
    {
        return $this->get("cuatrovientos_artean.bo.company")->findCompanies($request->query->get('term'));
    }

    /**
     * @Rest\View
     */
    public function advancedSearchAction(Request $request) {
        $form = $this->createForm(CompanySearchType::class, new Company());
        $logger = $this->get('logger');
        $response = "";
        $companies = array();
        $total = 0;

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            // if ($form->isValid()) {
            $company = $form->getData();
            $companies = $this->get("cuatrovientos_artean.bo.applicant")->searchCompanies($company,0,100);
            return $this->render('CuatrovientosArteanBundle:Applicant:applicantList.html.twig', array('companies' => $companies  ));
            //$applicants = $this->get("cuatrovientos_artean.bo.applicant")->detailedSearchApplicants($applicant);
            /*} else  {
                $applicants = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicants(0, 0, 10);
                $total = $this->get("cuatrovientos_artean.bo.applicant")->countAllApplicants();
                return $applicants;
            }*/
        }
        return $companies;
    }

}
