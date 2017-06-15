<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class StatsController extends Controller
{


    public function indexAction()
    {
        $logger = $this->get('logger');
        $jobRequestStats = $this->get("cuatrovientos_artean.bo.stats")->getJobRequestsStats();
        $logger->info('Stats: ');
       //$logger->info($jobRequestStats);
        return $this->render('CuatrovientosArteanBundle:Stats:stats.html.twig', array('jobRequestStats'=>$jobRequestStats));
    }  

}
