<?php
// src/AppBundle/Command/CreateUserCommand.php
namespace Cuatrovientos\ArteanBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SendPendingEmailsCommand
 * php bin/console artean:send-emails Wouter
 * @package Cuatrovientos\ArteanBundle\Command
 */
class SendPendingEmailsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('artean:send-emails')

            // the short description shown while running "php bin/console list"
            ->setDescription('Sends pending mail to recipients')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command is designed to be called from a cron task to send pending emails.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $mailings = $this->getContainer()->get("cuatrovientos_artean.bo.mailing")->findAllMailings(0, 0,10);
        $output->writeln([
            'Artean: Sending Pending Emails',
            '==============================',
            '',
        ]);

        for ($i = 0; $i < count($mailings);$i++) {
            // outputs a message followed by a "\n"
            $output->writeln('Whoa: ' . $mailings[$i]->getSubject());
            for ($i = 0; $i < count($mailings);$i++) {
                // outputs a message followed by a "\n"
                foreach ($mailings[$i]->getSelectedApplicants() as $applicant) {
                    $output->writeln('Sending to...: ' . $applicant->getName() .': '.$applicant->getEmail());
                    $this->sendEmail($mailings[$i], $applicant->getEmail());
                }

                foreach ($mailings[$i]->getSelectedCompanies() as $company) {
                    $output->writeln('Sending to...: ' . $company->getEmpresa() .': '.$company->getEmail());
                    $this->sendEmail($mailings[$i], $company->getEmail());
                }
            }
        }

        // outputs a message without adding a "\n" at the end of the line
        $output->write('You are about to ');
        $output->write('create a user.');
    }

    private function sendEmail ($mailing, $to, $template="Emails/standard.html.twig") {

        $message = \Swift_Message::newInstance()
            ->setSubject($mailing->getSubject())
            ->setFrom($mailing->getFrom())
            ->setTo($to)
            ->setBcc($mailing->getBcc())
            ->setBody($this->renderView(
                $template,
                array('content' => $mailing->getBody())
            ),'text/html'

            );

        $this->getContainer()->get('mailer')->send($message);
    }
}