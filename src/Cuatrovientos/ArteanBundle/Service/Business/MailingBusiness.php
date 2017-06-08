<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\Entity;
use Cuatrovientos\ArteanBundle\Entity\Mailing;
use Cuatrovientos\ArteanBundle\Entity\Company;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\MailingDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\CompanyDAO;
use Monolog\Logger;

class MailingBusiness extends GenericBusiness {

    private $companyDAO;
    private $applicantDAO;
    private $logger;
    private $mailer;
    private $templating;
    private $attachments_directory;

    public function __construct (MailingDAO $mailingDAO,
                                 CompanyDAO $companyDAO,
                                 ApplicantDAO $applicantDAO,
                                 Logger $logger,
                                 $mailer,
                                 $templating,
                                 $attachments_directory) {
        $this->entityDAO = $mailingDAO;
        $this->companyDAO = $companyDAO;
        $this->applicantDAO = $applicantDAO;
        $this->logger = $logger;
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->attachments_directory = $attachments_directory;
    }

    public function findAllMailings($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllMailings($id, $start,$total);
    }

    public function findAllPendingMailings($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllPendingMailings($id, $start,$total);
    }

    public function findMailings($term) {
        return $this->entityDAO->findMailings($term);
    }

    public function countAllMailings()
    {
        return $this->entityDAO->countAllMailings();
    }

    public function searchMailings($mailing, $start=0,$total=100)
    {
        return $this->entityDAO->searchMailings($mailing, $start, $total);
    }

    public function updateApplicantSelection(Entity $mailing) {
        $this->entityDAO->update($mailing);
    }

    public function updateCompanySelection(Entity $mailing) {
        $this->entityDAO->update($mailing);
    }

    public function deleteSelectedApplicant($mailingid, $applicantid)
    {
        return  $this->entityDAO-> deleteSelectedApplicant($mailingid, $applicantid);
    }


    public function deleteAllSelectedApplicants($mailingid)
    {
        return  $this->entityDAO->deleteAllSelectedApplicants($mailingid);
    }

    public function deleteSelectedCompany($mailingid, $companyid)
    {
        return  $this->entityDAO-> deleteSelectedCompany($mailingid, $companyid);
    }

    public function deleteAllSelectedCompanies($mailingid)
    {
        return  $this->entityDAO->deleteAllSelectedCompanies($mailingid);
    }

    public function deleteAttachment($mailingid, $attachmentid)
    {
        return  $this->entityDAO->deleteAttachment($mailingid, $attachmentid);
    }

    public function deleteAllAttachments($mailingid)
    {
        return  $this->entityDAO->deleteAllAttachments($mailingid);
    }

    public function startMailing($mailing)
    {
        //$logger = $this->container->get('logger');

            $this->logger->info('Whoa: ' . $mailing->getSubject());

            // outputs a message followed by a "\n"
            foreach ($mailing->getSelectedApplicants() as $applicant) {
                $this->logger->info('Sending to...: ' . $applicant->getName() .': '.$applicant->getEmail());
                $result = $this->sendEmail($mailing, $applicant->getEmail());
                $this->logger->info('Result ' . $result . ' for ' . $applicant->getEmail());
            }

            foreach ($mailing->getSelectedCompanies() as $company) {
                $this->logger->info('Sending to...: ' . $company->getEmpresa() .': '.$company->getEmail());
                //$result = $this->sendEmail($mailing, $company->getEmail());
                //$output->writeln('Result ' . $result . ' for ' . $company->getEmail());
            }

            $mailing->setStatus(3);
            $this->entityDAO->update($mailing);

        //print_r($this->failures);
        // outputs a message without adding a "\n" at the end of the line
        $this->logger->info('Thanks yo');

    }

    private function sendEmail ($mailing, $to, $template="Emails/standard.html.twig") {

        $message = \Swift_Message::newInstance()
            ->setSubject($mailing->getSubject())
            ->setFrom($mailing->getMailFrom())
            ->setTo($to)
            // ->setBcc($mailing->getBcc())
            ->setBody($this->templating->render(
                $template,
                array('content' => $mailing->getBody())
            ),'text/html'

            );

        foreach ($mailing->getmailingAttachments() as $attachment) {

            $message->attach(\Swift_Attachment::fromPath($this->attachments_directory.'/'.$attachment->getPath()));
        }

        $result =  $this->mailer->send($message); // getContainer()

        return $result;
    }

}
