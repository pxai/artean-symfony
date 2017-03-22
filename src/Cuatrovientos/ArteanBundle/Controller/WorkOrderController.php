<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query\ResultSetMapping;
use Cuatrovientos\ArteanBundle\Entity\WorkOrder;
use Cuatrovientos\ArteanBundle\Entity\News;
use Cuatrovientos\ArteanBundle\Form\Type\WorkOrderType;
use Cuatrovientos\ArteanBundle\Form\Type\NewsType;
use Symfony\Component\HttpFoundation\Session\Session;

class WorkOrderController extends Controller
{
    /**
    *
    *
    */
    public function indexAction()
    {

        $workOrders = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:WorkOrder")->findAll();
        return $this->render('CuatrovientosArteanBundle:WorkOrder:index.html.twig' , array('workOrders'=>$workOrders));
    }  
    
    /**
    *
    *
    */
   public function newWorkOrderAction()
    {
// set and get session attributes
        $form = $this->createForm(WorkOrderType::class);
        return $this->render('CuatrovientosArteanBundle:WorkOrder:new.html.twig' , array('form'=> $form->createView()));
    }

    /**
    *
    *
    */
    public function newWorkOrderSaveAction(Request $request)
    {
        //$form = $this->createForm(new WorkOrderType(), new WorkOrder());
        //$request->get('position')->set($request->request->get('company') .'=> , '. $request->request->get('position'));    
        $form = $this->createForm(WorkOrderType::class, new WorkOrder());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            //$form->submit($request->request->get($form->getName()));
            
            if ($form->isValid()) {
                $workOrder = $form->getData();
                $workOrder->setIdapplicant(1);
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($workOrder);
                $em->flush();
                $response =  $this->render('CuatrovientosArteanBundle:WorkOrder:newSave.html.twig' , array('workOrder' => $workOrder));
            } else {
                $response = $this->render('CuatrovientosArteanBundle:WorkOrder:new.html.twig' , array('form'=> $form->createView()));
            }
        }

        return $response;
    }

    private function sendEmail ($workOrder) {
         $message = \Swift_Message::newInstance()
        ->setSubject('Artean: ¡nueva solicitud de empleo iniciada por empresa!')
        ->setFrom('artean@cuatrovientos.org')
        ->setTo('artean@cuatrovientos.org')
        ->setBcc('pello_altadill@cuatrovientos.org')
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'Emails/newWorkOrder.html.twig' ,
                array('workOrder' => $workOrder)
            ),
            'text/html'
        );
        /*
         * If you also want to include a plaintext version of the message
        ->addPart(
            $this->renderView(
                'Emails/registration.txt.twig'=> ,
                array('name' => $name)
            ),
            'text/plain'
        )
        */
        $this->get('mailer')->send($message);

        //return $this->render(...);
    }
    /**
    *
    *
    */
   public function workOrderDetailAction($id=1)
    {
        $idapplicant = 1;
        $workOrder = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:WorkOrder")->findDetail($id, $idapplicant);
   
        return $this->render('CuatrovientosArteanBundle:WorkOrder:workOrder.html.twig' ,array('workOrder'=> $workOrder));
    }

    /**
    *
    *
    */
    public function workOrderUpdateAction($id) {
        $workOrder = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:WorkOrder")->find($id);
      
        $form = $this->createForm(WorkOrderType::class, $workOrder);

        return $this->render('CuatrovientosArteanBundle:WorkOrder:update.html.twig' ,array('form'=> $form->createView(),'id'=>$id));
    }
    
    /**
    *
    *
    */
    public function workOrderUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(WorkOrderType::class, new WorkOrder());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $workOrder = $form->getData();
                $workOrder->setIdapplicant(1);
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($workOrder);
                $em->flush();
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:WorkOrder:workOrderDetail' , array('id' => $workOrder->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:WorkOrder:updatePost.html.twig' , array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    /**
    *
    *
    */
   public function workOrderDeleteAction($id=1)
    {
        $workOrder = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:WorkOrder")->find($id);
        return $this->render('CuatrovientosArteanBundle:WorkOrder:delete.html.twig' ,array('workOrder'=> $workOrder));
    }

    /**
    *
    *
    */
   public function workOrderDeleteSaveAction(WorkOrder $workOrder)
    {
        $rsm = new ResultSetMapping();
       $em = $this->getDoctrine()->getEntityManager();
        
        // problems executing this, fot update, delete and insert not the best option
        // ?,?,?
        // Instead using prepared

        $sql = 'insert into tbsolicitudes (fechasolicitud, idempresa, att, saludo, contacto, descripcionempresa,horario, contrato,formacion, idiomas, vacantes, jornada,requisitos,perfil)
                  values (:fechasolicitud, 
                            :idempresa, 
                            :att, 
                            :saludo, 
                            :contacto, 
                            :descripcionempresa,
                            :horario, 
                            :contrato,
                            :formacion, 
                            :idiomas, 
                            :vacantes, 
                            :jornada,
                            :requisitos,
                            :perfil   
                  )';

        $params = array(
            'fechasolicitud' => date('d/M/Y'),
            'idempresa'=> 1,
            'att'=> 'Att',
            'saludo'=> 'Estimada/o',
            'contacto'=> $workOrder->getContact(),
            'descripcionempresa'=> $workOrder->getCompany().', ' .$workOrder->getDescription(),
            'horario'=> $workOrder->getSchedule(),
            'contrato'=> $workOrder->getContractType()->getId(),
            'formacion'=> $workOrder->getRequiredStudiesString(),
            'idiomas'=> $workOrder->getRequiredLanguagesString(),
            'vacantes'=> $workOrder->getPositionNo(),
            'jornada'=> $workOrder->getWorkday(),
            'requisitos'=> $workOrder->getOtherKnowledges(),
            'perfil'=>   $workOrder->getObservations());

        $statement = $em->getConnection()->prepare($sql);
        $statement->execute($params);
        $id = $em->getConnection()->lastInsertId();

        $em->remove($workOrder);
        $em->flush();
      // return $this->forward('CuatrovientosArteanBundle:WorkOrder:index');
        return $this->redirect('https://artean.cuatrovientos.org/?ap_manage_tbsolicitudes&ta=update&id='.$id);
    }

    
    /**
    * publish workOrder as
    *
    */
    public function newWorkOrderPublishAction($id)
    {
        $workOrder = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:WorkOrder")->findWorkOrder($id);
                
        $news = new News();
        $news->setTitle($workOrder->getCompany(). ' ' . $workOrder->getPosition());
        $news->setPermalink($this->get("cuatrovientos_artean.utils.permalink")->permalink($news->getTitle()));
        $news->setWhat(base64_encode($workOrder->getDescription()));
        $news->setNewsdate(time());
        $news->setWho(1);
        $news->setStatus(1);

        
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($news);
        $workOrder->setPublished(1);
        $em->persist($workOrder);
        
        $em->flush();

        $form = $this->createForm(NewsType::class, $news);
        return $this->render('CuatrovientosArteanBundle:News:update.html.twig',array('form'=> $form->createView(),'id'=>$news->getId()));

        return $response;
    }
}
