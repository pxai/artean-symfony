<?php

namespace Cuatrovientos\ArteanBundle\Security\Encoder;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Symfony\Component\Security\Core\Encoder\BasePasswordEncoder;
 
class Sha1PasswordEncoder extends BasePasswordEncoder
{
    /**
     * {@inheritdoc}
     */
    public function encodePassword($raw, $salt)
    {
        return $this->doEncode($raw);
    }
 
    /**
     * {@inheritdoc}
     */
    public function isPasswordValid($encoded, $raw, $salt)
    {
        $pass2 = $this->doEncode($raw);
        return $this->comparePasswords($encoded, $pass2);
    }
 
    /**
     * Do the actual encoding
     * @param $input
     * @return string
     */
    protected function doEncode($input)
    {
        return sha1($input);
    }
}
