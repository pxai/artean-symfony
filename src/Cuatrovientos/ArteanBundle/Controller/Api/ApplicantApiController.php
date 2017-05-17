<?php

namespace  Cuatrovientos\ArteanBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantAdvancedSearchType;

/* With this Circular reference is detected
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;*/

class ApplicantApiController extends Controller
{

    private $serializer;

    public function __construct () {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        // This solves circular reference
        foreach ($normalizers as $normalizer) {
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getId();
            });
        }

        $this->serializer = new Serializer($normalizers, $encoders);

    }

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
        $logger = $this->get('logger');
        $response = "";
        $applicants = array();
        $total = 0;

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
           // if ($form->isValid()) {
                $applicant = $form->getData();
                $applicants = $this->get("cuatrovientos_artean.bo.applicant")->searchApplicants($applicant,0,100);
                return $this->render('CuatrovientosArteanBundle:Applicant:applicantList.html.twig', array('applicants' => $applicants  ));
                //$applicants = $this->get("cuatrovientos_artean.bo.applicant")->detailedSearchApplicants($applicant);
            /*} else  {
                $applicants = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicants(0, 0, 10);
                $total = $this->get("cuatrovientos_artean.bo.applicant")->countAllApplicants();
                return $applicants;
            }*/
        }
        return $applicants;
    }
}
