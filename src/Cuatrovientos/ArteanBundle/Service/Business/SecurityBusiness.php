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

}
