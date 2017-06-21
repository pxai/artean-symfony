<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;



use Cuatrovientos\ArteanBundle\Entity\Email;
use Cuatrovientos\ArteanBundle\Service\DAO\OfferAdDAO;
use Cuatrovientos\ArteanBundle\Service\DAO\ApplicantDAO;
use Monolog\Logger;

class OfferAdBusiness extends GenericBusiness {


    private $applicantDAO;
    private $mailer;
    private $templating;
    private $logger;

    public function __construct (OfferAdDAO $offerAdDAO,
                                 ApplicantDAO $applicantDAO,
                                 Logger $logger,
                                 $mailer,
                                 $templating) {
        $this->entityDAO = $offerAdDAO;
        $this->applicantDAO = $applicantDAO;
        $this->logger = $logger;
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function findAllOfferAds($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllOfferAds($id, $start,$total);
    }

    public function findAllPublishedOffersAd($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllPublishedOfferAds($id, $start,$total);
    }

    public function findAllOfferAdsByType($id=0)
    {
        return $this->entityDAO->findAllOfferAdsByType($id);
    }

    public function findAllOfferAdsByStatus($status=0)
    {
        return $this->entityDAO->findAllOfferAdsByStatus($status);
    }

    public function findOfferAds($term) {
        return $this->entityDAO->findOfferAds($term);
    }


    public function countAllOfferAds()
    {
        return $this->entityDAO->countAllOfferAds();
    }

    public function searchOfferAds($offer, $start=0,$total=100)
    {
        return $this->entityDAO->searchOfferAds($offer, $start, $total);
    }

    public function notifyApplicants($offer)
    {
        if ($offer->isPublishedAndShouldBeNotified()) {
            $this->logger->info("Time to notify...");
            $this->sendEmails($offer,$this->applicantDAO->findApplicantsByDegree($offer->getRequiredStudies()));
            $offer->setNotified(1);
            return $this->entityDAO->update($offer);
        }

    }

    private function sendEmails ($offer,$applicants) {
        foreach ($applicants as $a) {
            $this->logger->info("Sending email to: " . $a->getEmail());
            $this->sendEmail(
                    new Email("artean@cuatrovientos.org",$a->getEmail(),"","[Artean] ¡Nueva oferta de empleo!",""),
                    $offer);
        }
    }

    private function sendEmail ($email, $offer) {
        $message = \Swift_Message::newInstance()
                ->setSubject($email->getSubject())
                ->setFrom($email->getFrom())
                ->setTo($email->getTo())
                ->setBody($this->templating->render(
                    "Emails/newOfferAd.html.twig",
                    array('offer' => $offer)
                ),'text/html'
            );
        $this->logger->info("Sending email to: " . $offer->getDescription());
        return  $this->mailer->send($message);
    }

}
