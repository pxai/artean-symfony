<?php

namespace Cuatrovientos\ArteanBundle\Entity;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

class ChangePassword
{
    /**
    * @SecurityAssert\UserPassword(
    *     message = "Wrong value for your current password"
    * )
    */
    protected $oldPassword;

    /**
    * @Assert\Length(
    *     min = 6,
    *     minMessage = "Password should by at least 6 chars long"
    * )
    */
    protected $newPassword;

    /**
     * @Assert\Length(
     *     min = 6,
     *     minMessage = "Password should by at least 6 chars long"
     * )
     */
    protected $newPasswordRepeat;

    /**
     * @Assert\Length(
     *     min = 50,
     *     minMessage = "Password should by at least 50 chars long"
     * )
     */
    private $validate;

    /**
     * @return mixed
     */
    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    /**
     * @param mixed $oldPassword
     */
    public function setOldPassword($oldPassword)
    {
        $this->oldPassword = $oldPassword;
    }

    /**
     * @return mixed
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * @param mixed $newPassword
     */
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;
    }

    /**
     * @return mixed
     */
    public function getNewPasswordRepeat()
    {
        return $this->newPasswordRepeat;
    }

    /**
     * @param mixed $newPasswordRepeat
     */
    public function setNewPasswordRepeat($newPasswordRepeat)
    {
        $this->newPasswordRepeat = $newPasswordRepeat;
    }

    /**
     * @return mixed
     */
    public function getValidate()
    {
        return $this->validate;
    }

    /**
     * @param mixed $validate
     */
    public function setValidate($validate)
    {
        $this->validate = $validate;
    }



}