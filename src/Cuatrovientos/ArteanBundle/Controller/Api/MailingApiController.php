<?php

namespace  Cuatrovientos\ArteanBundle\Controller\Api;

use Cuatrovientos\ArteanBundle\Form\Type\JobRequestSelectedType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\MailingAttachment;
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

    /**
     * @Rest\View
     */
    public function deleteSelectedCompanySaveAction($mailingid, $companyid) {
        $result = $this->get("cuatrovientos_artean.bo.mailing")->deleteSelectedCompany($mailingid, $companyid);
        return '{"mailingid":'.$mailingid.',"result":'.$result.'}';
    }

    /**
     * @Rest\View
     */
    public function deleteOneAttachmentAction($mailingid,$attachmentid) {
        $result = $this->get("cuatrovientos_artean.bo.mailing")->deleteAttachment($mailingid, $attachmentid);
        return '{"mailingid":'.$mailingid.',"result":'.$attachmentid.'}';
    }

    /**
     * @Rest\View
     */
    public function deleteAttachmentsAction($mailingid) {
        $result = $this->get("cuatrovientos_artean.bo.mailing")->deleteAllAttachments($mailingid);
        return '{"mailingid":'.$mailingid.',"result":'.$mailingid.'}';
    }
    /**
     * @Rest\View
     */
    public function uploadAttachmentAction($id, Request $request) {
        $mailing = $this->get("cuatrovientos_artean.bo.mailing")->selectById($id);
        $logger = $this->get('logger');

        foreach ($request->files->all() as $file) {
            if(!is_null($file)){

                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                $file->move(
                    $this->getParameter('attachments_directory'),
                    $fileName
                );
                $attachment = new MailingAttachment();
                $attachment->setPath($fileName);
                $attachment->setName($file->getClientOriginalName());
                $attachment->setMailing($mailing);
                $mailing->addMailingAttachments($attachment);
                $this->get("cuatrovientos_artean.bo.mailing")->update($mailing);
                $lastId = $mailing->getMailingAttachments()->last()->getId();
            }
        }
        $logger->info("Ok, something was uploaded: " . $id . ' or: ' . $fileName);
       // $result = $this->get("cuatrovientos_artean.bo.mailing")->deleteSelectedApplicant($mailingid, $applicantid);
        return '{"attachmentid":"'.$lastId.'","result":0}';
    }

}
