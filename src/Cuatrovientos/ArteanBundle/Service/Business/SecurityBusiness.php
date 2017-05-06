<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\User;
use Cuatrovientos\ArteanBundle\Service\DAO\UserDAO;


class SecurityBusiness extends GenericBusiness {

    public function updatePassword($user, $changePassword) {
        $user->setPassword($changePassword->getNewPassword());
        $this->entityDAO->update($user);
        return true;
    }

    public function prepareForPasswordReset($email) {
        if ($user = $this->findUserByEmail($email)) {
            $user->setValidate($this->generatePassword(75));
            $this->entityDAO->update($user);
            return $user;
        } else {
            return null;
        }
    }

    public function resetPassword($resetPassword) {
        if ($user = $this->findUserByValidate($resetPassword->getValidate())) {
            $user->setValidate('');

            return $this->updatePassword($user, $resetPassword)?$user:null;
        } else {
            return null;
        }
    }

    public function findUserByEmail($email) {
        return $this->entityDAO->findUserByEmail($email);
    }

    public function findUserByValidate($validate) {
        return $this->entityDAO->findUserByValidate($validate);
    }

    public function findAllUsers($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllUsers($id, $start,$total);
    }


    public function findUsers($term) {
        return $this->entityDAO->findUsers($term);
    }


    public function countAllUsers()
    {
        return $this->entityDAO->countAllUsers();
    }

    public function searchUsers($user, $start=0,$total=100)
    {
        return $this->entityDAO->searchUsers($user, $start, $total);
    }

    public function generatePassword ($len=8)
    {
        $caracteres = "abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789";
        $tot = strlen($caracteres);

        $result = "";

        for ($i=0;$i<$len;$i++)
        {
            $result .= $caracteres[rand(0,$tot-1)];
        }

        return $result;
    }
}
