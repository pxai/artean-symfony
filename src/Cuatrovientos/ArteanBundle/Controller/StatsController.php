<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class StatsController extends Controller
{


    public function indexAction()
    {
        $jobRequestStats = $this->get("cuatrovientos_artean.bo.stats")->getJobRequestsStats();
        return $this->render('CuatrovientosArteanBundle:Stats:stats.html.twig', array());
    }  

}
