<?php

namespace Cuatrovientos\ArteanBundle\Security\User;

use Cuatrovientos\ArteanBundle\Entity\User;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class DatabaseUserProvider  implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {

      /*  $qb = $this->createQueryBuilder();
        $qb->select('u')
            ->from('CuatrovientosArteanBundle:User', 'u')
            ->where('u.username = :username')
            ->setParameter('username', $username)
            ->setMaxResults(1);
        $user = $qb->getQuery()->getResult();*/

       $user = new User();
        if ($user) {

            return $user;
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}