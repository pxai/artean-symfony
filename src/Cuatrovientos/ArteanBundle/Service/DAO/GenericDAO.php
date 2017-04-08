<?php

namespace Cuatrovientos\ArteanBundle\Service\DAO;

use Doctrine\ORM\EntityManager;

/**
 * GenericDAO
 */
abstract class GenericDAO {

    protected $entityType;
    protected $em;
    protected $repository;

    function __construct($entityType, EntityManager $em) {
        $this->entityType = $entityType;
        $this->em = $em;
        $this->repository = $this->em->getRepository($this->entityType);
    }

    /**
     * select one
     * @param type $id
     */
    public function selectById($id, $field = 'id') {
        return $this->repository->findOneBy(array($field => $id));
    }

    /**
     * selectBy any params given
     * @param type $params
     * @return type
     */
    public function selectBy($params) {
        return $this->repository->findOneBy($params);
    }

    /**
     * select all items
     */
    public function selectAll() {
        return $this->repository->findAll();
    }

    /**
     * create one Item entity
     * @param Item $entity
     */
    public function create($entity) {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity->getId();
    }

    /**
     * update Item
     * @param $entity
     */
    public function update ($entity) {
        $this->em->merge($entity);
        $this->em->flush();
    }

    /**
     * remove entity
     * @param $entity
     */
    public function remove ($entity) {
       $this->em->remove($entity);
       $this->em->flush();
    }

    /**
     * remove entity by id
     * @param $entity
     */
    public function removeById ( $id) {
        $this->em->remove($id);
        $this->em->flush();
    }
}
