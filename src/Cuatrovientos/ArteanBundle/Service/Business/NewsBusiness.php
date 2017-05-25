<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Cuatrovientos\ArteanBundle\Entity\News;
use Cuatrovientos\ArteanBundle\Service\DAO\NewsDAO;


class NewsBusiness extends GenericBusiness {

    public function findAllNews($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllNews($id, $start,$total);
    }

    public function findAllPublishedNews($id=0, $start=0,$total=100)
    {
        return $this->entityDAO->findAllPublishedNews($id, $start,$total);
    }

    public function findAllNewsByType($id=0)
    {
        return $this->entityDAO->findAllNewsByType($id);
    }

    public function findAllNewsByStatus($status=0)
    {
        return $this->entityDAO->findAllNewsByStatus($status);
    }

    public function findNews($term) {
        return $this->entityDAO->findNews($term);
    }


    public function countAllNews()
    {
        return $this->entityDAO->countAllNews();
    }

    public function searchNews($page, $start=0,$total=100)
    {
        return $this->entityDAO->searchNews($page, $start, $total);
    }

}
