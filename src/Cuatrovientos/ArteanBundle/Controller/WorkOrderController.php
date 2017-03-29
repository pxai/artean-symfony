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
    private $user;

    public function initialize()
    {

    }

    public function indexAction()
    {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $workOrders = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:WorkOrder")->findAllOrders($this->user->getId());
        return $this->render('CuatrovientosArteanBundle:WorkOrder:index.html.twig' , array('workOrders'=>$workOrders));
    }  
    

   public function newWorkOrderAction()
    {
        $form = $this->createForm(WorkOrderType::class);
        return $this->render('CuatrovientosArteanBundle:WorkOrder:new.html.twig' , array('form'=> $form->createView()));
    }


    public function newWorkOrderSaveAction(Request $request)
    {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm(WorkOrderType::class, new WorkOrder());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            //$form->submit($request->request->get($form->getName()));
            
            if ($form->isValid()) {
                $workOrder = $form->getData();
                $workOrder->setIdapplicant($this->user->getId());
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($workOrder);
                $em->flush();
                $response =  $this->redirectToRoute("cuatrovientos_artean_workorder");
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

   public function workOrderDetailAction($id=1)
    {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $idapplicant = $this->user->getId();
        $workOrder = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:WorkOrder")->findDetail($id, $idapplicant);
   
        return $this->render('CuatrovientosArteanBundle:WorkOrder:workOrder.html.twig' ,array('workOrder'=> $workOrder));
    }


    public function workOrderUpdateAction($id) {
        $workOrder = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:WorkOrder")->find($id);

      
        $form = $this->createForm(WorkOrderType::class, $workOrder);

        return $this->render('CuatrovientosArteanBundle:WorkOrder:update.html.twig' ,array('form'=> $form->createView(),'id'=>$id));
    }
    

    public function workOrderUpdateSaveAction(Request $request) {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm(WorkOrderType::class, new WorkOrder());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $workOrder = $form->getData();
                $workOrder->setIdapplicant($this->user->getId());
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($workOrder);
                $em->flush();
                
                // redirect to index
                $response =  $this->redirectToRoute("cuatrovientos_artean_workorder");
                //$response = $this->forward('CuatrovientosArteanBundle:WorkOrder:workOrderDetail' , array('id' => $workOrder->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:WorkOrder:updatePost.html.twig' , array('form'=> $form->createView()));
            }
        }
        return $response;
    }


   public function workOrderDeleteAction($id=1)
    {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $workOrder = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:WorkOrder")->find($id);
        return $this->render('CuatrovientosArteanBundle:WorkOrder:delete.html.twig' ,array('workOrder'=> $workOrder));
    }


   public function workOrderDeleteSaveAction(WorkOrder $workOrder)
   {
       $this->user = $this->get('security.token_storage')->getToken()->getUser();
       $em = $this->getDoctrine()->getEntityManager();
       if ($workOrder->getIdapplicant() == $this->user->getId()) {
       $em->remove($workOrder);
       $em->flush();
       return $this->redirectToRoute("cuatrovientos_artean_workorder");
   }

    }

}
