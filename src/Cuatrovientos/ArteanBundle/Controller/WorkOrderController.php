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
use Symfony\Component\Form\Extension\Core\Type\TextType;

class WorkOrderController extends Controller
{
    private $user;

    public function initialize()
    {

    }

    public function indexAction()
    {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        //$workOrders = $this->get("api_inventory.bo.article")->findAllOrders($this->user->getId());
        $workOrders = $this->get("cuatrovientos_artean.bo.workorders")->findAllOrders($this->user->getId());
       // $workOrders = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:WorkOrder")->findAllOrders($this->user->getId());
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
/*                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($workOrder);
                $em->flush();*/
                $this->get("cuatrovientos_artean.bo.workorders")->create($workOrder);
                $response =  $this->redirectToRoute("cuatrovientos_artean_workorder");
            } else {
                $response = $this->render('CuatrovientosArteanBundle:WorkOrder:new.html.twig' , array('form'=> $form->createView()));
            }
        }

        return $response;
    }



   public function workOrderDetailAction($id=1)
    {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $idapplicant = $this->user->getId();
        //$workOrder = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:WorkOrder")->findDetail($id, $idapplicant);
        $workOrder = $this->get("cuatrovientos_artean.bo.workorders")->findDetail($id, $idapplicant);
        return $this->render('CuatrovientosArteanBundle:WorkOrder:workOrder.html.twig' ,array('workOrder'=> $workOrder));
    }


    public function workOrderUpdateAction($id) {
       // $workOrder = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:WorkOrder")->find($id);
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $idapplicant = $this->user->getId();
        $workOrder = $this->get("cuatrovientos_artean.bo.workorders")->findDetail($id, $idapplicant);
      
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
 /*               $em = $this->getDoctrine()->getEntityManager();
                $em->merge($workOrder);
                $em->flush();*/
                $this->get("cuatrovientos_artean.bo.workorders")->update($workOrder);
                // redirect to index
                $response =  $this->redirectToRoute("cuatrovientos_artean_workorder");
                //$response = $this->forward('CuatrovientosArteanBundle:WorkOrder:workOrderDetail' , array('id' => $workOrder->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:WorkOrder:update.html.twig' , array('form'=> $form->createView(),'id'=> $form->get('id')->getData()));
            }
        }
        return $response;
    }


   public function workOrderDeleteAction($id=1)
    {
        $this->user = $this->get('security.token_storage')->getToken()->getUser();
        $idapplicant = $this->user->getId();
        $workOrder = $this->get("cuatrovientos_artean.bo.workorders")->findDetail($id, $idapplicant);
        return $this->render('CuatrovientosArteanBundle:WorkOrder:delete.html.twig' ,array('workOrder'=> $workOrder));
    }


   public function workOrderDeleteSaveAction(WorkOrder $workOrder)
   {
       $this->user = $this->get('security.token_storage')->getToken()->getUser();
       $em = $this->getDoctrine()->getEntityManager();
       if ($workOrder->getIdapplicant() == $this->user->getId()) {
          /* $em->remove($workOrder);
           $em->flush();*/
           $this->get("cuatrovientos_artean.bo.workorders")->remove($workOrder);
           return $this->redirectToRoute("cuatrovientos_artean_workorder");
       }
   }


       public function printAction(Request $request)
   {
       $this->user = $this->get('security.token_storage')->getToken()->getUser();
       $init = "";
       $end = "";
       if ($request->getMethod() == 'GET') {
           return $this->render('CuatrovientosArteanBundle:WorkOrder:print.html.twig', array("init"=>$init, "end"=>$end,"workOrders"=>array()));
       } elseif ($request->getMethod() == 'POST') {
           $defaultData = array('message' => 'Imprimir partes');
           $form = $this->createFormBuilder($defaultData)
               ->add('init', TextType::class)
               ->add('end', TextType::class)
               ->getForm();


           $form->handleRequest($request);

           $init = $request->request->get("init");
           $end = $request->request->get("end");
           $dates = $this->getInitEndDates($init, $end);
           //$logger->info('Yeah: ' . $dates[0] . ' and  ' . $dates[1]);
           $workOrders = $this->get("cuatrovientos_artean.bo.workorders")->findOrdersInDateRange($dates[0],$dates[1],$this->user->getId());
           //$workOrders = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:WorkOrder")->findOrdersInDateRange($dates[0],$dates[1],$this->user->getId());

           return $this->render('CuatrovientosArteanBundle:WorkOrder:print.html.twig', array("init"=>$init, "end"=>$end,"workOrders"=> $workOrders));

       }
   }


       public function printSaveAction(Request $request)
   {
       $this->user = $this->get('security.token_storage')->getToken()->getUser();

       $logger = $this->get('logger');


       if ($request->getMethod() == 'POST') {
           $defaultData = array('message' => 'Imprimir partes');
           $form = $this->createFormBuilder($defaultData)
               ->add('init', TextType::class)
               ->add('end', TextType::class)
               ->getForm();
           $init = "init";
           $end = "end";
           $name = $this->user->getUsername();

           $form->handleRequest($request);

           $init = $request->request->get("init");
           $end = $request->request->get("end");
           $dates = $this->getInitEndDates($init, $end);
           //$logger->info('Yeah: ' . $dates[0] . ' and  ' . $dates[1]);
          // $workOrders = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:WorkOrder")->findOrdersInDateRange($dates[0],$dates[1],$this->user->getId());
            $workOrders = $this->get("cuatrovientos_artean.bo.workorders")->findOrdersInDateRange($dates[0],$dates[1],$this->user->getId());

           return $this->render('CuatrovientosArteanBundle:WorkOrder:printSave.html.twig', array("init"=>$init, "end"=>$end,"workOrders"=> $workOrders,"name"=>$name));

       }


    }

    private function  getInitEndDates ($init, $end) {
        $dataInit = preg_split("/\-/",$init);
        $dataEnd = preg_split("/\-/",$end);
        $weekInit = ltrim($dataInit[1],'W');
        $weekEnd = ltrim($dataEnd[1],'W');

        $dates = array();
        $dto = new \DateTime();

        $dto->setISODate($dataInit[0], $weekInit);
        $ret['week_start1'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ret['week_end1'] = $dto->format('Y-m-d');

        $dates[0] = $ret['week_start1'];

        $dto->setISODate($dataEnd[0], $weekEnd);
        $ret['week_start2'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ret['week_end2'] = $dto->format('Y-m-d');

        $dates[1] = $ret['week_start2'];

        return $dates;
    }

}
