<?php

namespace Cuatrovientos\ArteanBundle\Entity;


class Email {
    private $from;
    private $to;
    private $bcc;
    private $subject;
    private $body;

    /**
     * Email constructor.
     * @param $from
     * @param $to
     * @param $bcc
     * @param $subject
     * @param $body
     */
    public function __construct($from, $to, $bcc, $subject, $body)
    {
        $this->from = $from;
        $this->to = $to;
        $this->bcc = $bcc;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @param mixed $bcc
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }


}