<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

/**
 * Pello Altad
 * UserDAO
 * Extends GenericDAO
 */
class UserDAO extends GenericDAO {

    public function findAllUsers($id=0, $start=0,$total=100)
    {
        return $this->repository->createQueryBuilder('m')
            ->where('m.id > :id')
            ->setParameter('id',$id)
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }


    public function countAllUsers()
    {
        return $this->repository->createQueryBuilder('m')
            ->select('count(m.id)')
            ->from('CuatrovientosArteanBundle:User','user')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchUsers($user, $start=0,$total=100)
    {
        return  $this->repository->createQueryBuilder('m')
            ->where('m.login LIKE :login')
            ->setParameter('login','%'.$user->getUsername().'%')
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($total)
            ->getResult();
    }
    
    public function findAllUserData($id)
    {
        $repository = $this->em->getRepository($this->entityType);
        return $repository->createQueryBuilder('a')
            ->where('a.id = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getOneOrNullResult();
    }



    public function findUsers($term)
    {
        $repository = $this->em->getRepository('CuatrovientosArteanBundle:User');
        return $repository->createQueryBuilder('m')
            ->where('m.login like :login')
            ->orWhere('m.email like :login')
            ->setParameter('login','%'.$term.'%')
            ->orderBy('m.login', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findUserByEmail($email)
    {
        $repository = $this->em->getRepository('CuatrovientosArteanBundle:User');
        return $repository->createQueryBuilder('m')
            ->where('m.login=:email')
            ->orWhere('m.email=:email')
            ->setParameter('email',$email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findUserByValidate($validate)
    {
        $repository = $this->em->getRepository('CuatrovientosArteanBundle:User');
        return $repository->createQueryBuilder('m')
            ->where('m.validate=:validate')
            ->setParameter('validate',$validate)
            ->getQuery()
            ->getOneOrNullResult();
    }

}

