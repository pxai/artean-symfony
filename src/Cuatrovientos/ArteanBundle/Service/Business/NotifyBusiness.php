<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;


use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\MailingDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\CompanyDAO;
use Monolog\Logger;

class NotifyBusiness extends GenericBusiness {

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
